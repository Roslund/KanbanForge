<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artifact;
use App\Card;
use DB;



use Illuminate\Support\Facades\Input;

class ArtifactController extends Controller {


	public function __construct() {

    $this->middleware('userisadmin');
  }

  public function index() {
        //Gets the artifacts from the database! :)
    $artifacts = Artifact::all()->sortByDesc("id");
		$cards = DB::table('cards')->pluck('artifact_id')->toArray();
    return view('admin.artifacts.index',compact(['artifacts','cards']));
  }


   public function select(Request $request) {

      $ids = Input::get('id');
      if($ids)
      {
				$cards = DB::table('cards')->pluck('artifact_id')->toArray();
				//finding items that are in request but not in card db for dublicated values
				$missing = array_diff($ids, $cards);
				//finding items that are in card db but nut in request
				$remove = array_diff( $cards,$ids);
				if($missing)
				//adding values to cards
        foreach ($missing as $id) {
          $card = new Card;
          $card->artifact_id = $id;
          $card->category_id = 1;
          $card->swimlane_id = Null;
          $card->save();
          }
					//removing items that have been unselected
					foreach ($remove as $item) {
						DB::table('cards')->where('artifact_id', $item)->delete();
					}
      }
			//if no selected items then remove all from card db
			else
			{
				DB::table('cards')->truncate();
			}
      return redirect('/board');
  }


  public function refresh(){

    Artifact::refresh_all_artifacts_from_teamforge();

      return redirect('/admin/filter');
    }

}
