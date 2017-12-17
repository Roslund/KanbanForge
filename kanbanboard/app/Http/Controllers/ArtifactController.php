<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artifact;
use App\Card;



use Illuminate\Support\Facades\Input;

class ArtifactController extends Controller {


	public function __construct() {

    $this->middleware('userisadmin');
  }

  public function index() {
        //Gets the artifacts from the database! :)
    $artifacts = Artifact::all()->sortByDesc("id");

    return view('admin.artifacts.index',compact(['artifacts']));
  }


   public function select(Request $request) {

      $ids = Input::get('id');
      if($ids)
      {
        foreach ($ids as $id) {
          $card = new Card;
          $card->artifact_id = $id;
          $card->category_id = 1;
          $card->swimlane_id = Null;
          $card->save();
          }
          return view('admin.artifacts.selected', compact('ids'));
      }
      return redirect('/admin/filter');
  }


  public function refresh(){

    Artifact::refresh_all_artifacts_from_teamforge();

      return redirect('/admin/filter');
    }

}
