<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artifact;

class ArtifactController extends Controller
{
    public function index(){
        $artifacts = Artifact::all();
        return view('artifact', compact('artifacts'));
    }

    /*public function show(Task $task){
        return view('tasks.show', compact('task'));
    }

    public function welcome(){
      $tasks = Task::all();
      return view('welcome', compact('tasks'));
    }*/
}
