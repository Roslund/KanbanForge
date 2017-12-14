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
      //all checkboxes that are checked
      $checkboxes = $request->input('checkbox');
      //all checkboxes
      $values = $request->input('all_checkboxes');
      //if we have any checked then update 
      if($checkboxes)
      {
        //find all unchecked to update the database
        $unchecked = array_diff($values, $checkboxes);
        //Do the checked Update
        foreach($checkboxes as $item)
        {
          $projects = Project::where('project_id',$item)->first();
          if($projects)
          {
            $projects->artifact_fetch = 1;
            $projects->save();
          }

        }
        //do the unchecked update
        foreach($unchecked as $item)
        {
          $projects = Project::where('project_id',$item)->first();
          if($projects)
          {
            $projects->artifact_fetch = 0;
            $projects->save();
          }

        }
          return redirect('/board');
      }
      //If there is no checked checkbox the uncheck all in database
      else
      {
        foreach($values as $item)
        {
          $projects = Project::where('project_id',$item)->first();
          if($projects)
          {
            $projects->artifact_fetch = 0;
            $projects->save();
          }

        }
          return redirect('/board');

      }

    }

    public function refresh(){

      Project::refresh_all_projects_from_teamforge();

        return redirect('/admin/projects');
      }
}
