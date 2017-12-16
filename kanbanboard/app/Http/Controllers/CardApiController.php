<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Category;
use App\Swimlane;

class CardApiController extends Controller
{
    // Only authenticated users can use this api.
    /*public function __construct()
    {
      $this->middleware('auth');
    }*/

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
        return Card::join('artifacts', 'cards.artifact_id', '=', 'artifacts.id')->
          select('cards.*',
            'artifacts.assignedTo',
            'artifacts.description',
            'artifacts.title',
            'artifacts.createdDate as teamforgeCreatedDate',
            'artifacts.status')->where('cards.id', $id)->get();
    }

    /**
     * Update the specified card in storage.
     * PUT /cards/{id}
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // A card will always belong to a category, but it doesn't
        // necessarily belong to a swimlane.
        $this->validate(request(), [
          'category_id' => 'integer|required',
          'swimlane_id' => 'integer|nullable'
        ]);

        $category_id = request('category_id');
        $swimlane_id = request('swimlane_id');

        $queryReturnValue = Card::where('id', $id)->update(
          ['category_id' => $category_id,
          'swimlane_id' => $swimlane_id]);

        return array('timestamp' => date("Y-m-d H:i:s"), 'success' => $queryReturnValue);
    }

    public function checkIfUpdatedSince(Request $request)
    {
        $lastUpdated = request('timestamp');
        $metadataObject = request('metadataObject');

        $categoryCount = $metadataObject['categoryCount'];
        $swimlaneCount = $metadataObject['swimlaneCount'];

        if(Card::where('updated_at', '>', $lastUpdated)->get()->count() > 0)
        {
          return array('timestamp' => date("Y-m-d H:i:s"), 'metadataObject' => $metadataObject, 'response' => 1);
        }

        // if cards haven't changed then we'll check if categories or swimlanes have
        if(Category::all()->count() != $categoryCount || Swimlane::all()->count() != $swimlaneCount)
        {
          $newMetadataObject = array( "categoryCount" => Category::all()->count(), "swimlaneCount" => Swimlane::all()->count() );
          return array('timestamp' => date("Y-m-d H:i:s"), 'metadataObject' => $newMetadataObject, 'response' => 1);
        }

        return array('timestamp' => date("Y-m-d H:i:s"), 'response' => 0);
    }
}
