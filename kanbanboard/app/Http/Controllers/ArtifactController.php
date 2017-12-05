<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artifact;

class ArtifactController extends Controller {
    //Gets the artifacts from the database! :) 
    public function index(){
        $artifacts = Artifact::all();
        return $artifacts;
    }
}
