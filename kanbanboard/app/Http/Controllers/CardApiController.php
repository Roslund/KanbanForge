<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Category;
use App\Swimlane;
use App\ParentCategory;
use App\Artifact;
use App\BoardLog;

class CardApiController extends Controller
{
    /**
     * Display a listing of all cards.
     * GET /api/cards/
     *
     * @return JSON collection
     */

    public function index()
    {
        $cards = Card::all();

        return array('timestamp' => date("Y-m-d H:i:s"), 'data' => $cards);
    }

    /**
     * Display the specified card.
     * GET /api/cards/{id}
     *
     * @param  int  $id
     * @return JSON formatted card.
     */
    public function show($id)
    {
        $cardValueInDB = Card::where('id', $id)->get()->first();

        $includeKeys = ['id', 'title', 'description', 'category', 'group',
          'status', 'statusClass', 'customer', 'priority', 'estimatedEffort',
          'actualEffort', 'remainingEffort', 'points', 'closeDate',
          'assignedTo', 'teamId', 'flexFields', 'lastModifiedBy', 'createdBy',
          'lastModifiedDate', 'createdDate'];

        $artiactValuesInTF = Artifact::get_artifact_by_id($cardValueInDB['artifact_id'], $includeKeys);

        if($artiactValuesInTF != null)
        {
          // now that we're done with this value we unset it so that it
          // doesn't get returned twice.
          unset($cardValueInDB['artifact_id']);

          return array(
            'dbValues' => $cardValueInDB,
            'teamforgeValues' => $artiactValuesInTF
          );
        }

        // if all else fails, get the artifact and card data we have in the database.
        $backupQuery = Card::join('artifacts', 'cards.artifact_id', '=', 'artifacts.id')->
          select('cards.*',
            'artifacts.assignedTo',
            'artifacts.description',
            'artifacts.title',
            'artifacts.createdDate as teamforgeCreatedDate',
            'artifacts.status')->where('cards.id', $id)
            ->get()->first();

        return array(
          'dbValues' => $backupQuery,
          'teamforgeValues' => null
        );
    }

    /**
     * Update the specified card in storage.
     * PUT /cards/{id}
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $card_id)
    {
        // A card will always belong to a category, but it doesn't
        // necessarily belong to a swimlane.
        $this->validate(request(), [
          'category_id' => 'integer|required',
          'swimlane_id' => 'integer|nullable',
          'user_id' => 'integer|required'
        ]);

        $category_id = request('category_id');
        $swimlane_id = request('swimlane_id');
        $user_id = request('user_id');

        $queryReturnValue = Card::where('id', $card_id)->update(
          ['category_id' => $category_id,
          'swimlane_id' => $swimlane_id]);

        $message = "Card " . $card_id . " was moved to category " . $category_id . " swimlane " . ($swimlane_id == null ? "null" : $swimlane_id);
        BoardLog::logBoardEvent(2, "Card_Movement", $message);

        return array('timestamp' => date("Y-m-d H:i:s"), 'success' => $queryReturnValue);
    }

    public function checkIfUpdatedSince(Request $request)
    {
        $lastUpdated = request('timestamp');
        $metadataObject = request('metadataObject');

        // check for if swimlanes, categories or cards have been added or removed.
        if(Category::all()->count() != $metadataObject['categoryCount']
          || Swimlane::all()->count() != $metadataObject['swimlaneCount']
          || Card::all()->count() != $metadataObject['cardCount'])
        {
          $newMetadataObject = array( "categoryCount" => Category::all()->count(),
            "swimlaneCount" => Swimlane::all()->count(),
            "cardCount" => Card::all()->count());

          return array('timestamp' => date("Y-m-d H:i:s"), 'metadataObject' => $newMetadataObject, 'response' => 1);
        }

        // check for if swimlanes, categories of cards have been edited since last check.
        // We also check for if a parent category has been updated.
        // (As that's the only relevant parent category related update we need to keep track of)
        if(Card::where('updated_at', '>', $lastUpdated)->get()->count() > 0
          || Category::where('updated_at', '>', $lastUpdated)->get()->count() > 0
          || Swimlane::where('updated_at', '>', $lastUpdated)->get()->count() > 0
          || ParentCategory::where('updated_at', '>', $lastUpdated)->get()->count() > 0)
        {
          return array('timestamp' => date("Y-m-d H:i:s"), 'metadataObject' => $metadataObject, 'response' => 1);
        }

        return array('timestamp' => date("Y-m-d H:i:s"), 'response' => 0);
    }
}
