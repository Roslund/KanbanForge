<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DELETE /api/cards/{id}
    }

    public function checkIfUpdatedSince($dateTime)
    {
        if(Card::where('updated_at', '>', $dateTime)->get()->count() > 0)
        {
          return 1;
        }
        else
        {
          return 0;
        }
    }
}
