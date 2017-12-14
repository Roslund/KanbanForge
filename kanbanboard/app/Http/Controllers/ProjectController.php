<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Project;
use Auth;
use DB;

class ProjectController extends Controller
{

    public function __construct()
    {
      $this->middleware('userisadmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $project = Project::all();

      return view('admin.projects.index',compact('project'));
    }

    public function change(Request $request)
    {
      $myCheckboxes = $request->input('checkbox');
      if($myCheckboxes)
      {
        foreach($myCheckboxes as $item)
        {
          $projects = Project::where('project_id',$item)->first();
          if($projects)
          {
            $projects->artifact_fetch = 1;
            $projects->save();
          }

        }
          return redirect('/board');
      }
      return back();
    }

    public function refresh(){

      Project::refresh_all_projects_from_teamforge();

        return redirect('/admin/projects');
      }
}
