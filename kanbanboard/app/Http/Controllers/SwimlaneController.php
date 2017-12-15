<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Swimlane;
use Auth;

class SwimlaneController extends Controller
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
        $swimlanes = Swimlane::orderBy('sortnumber', 'asc')->paginate(10);
        return view('admin.swimlane.index', compact('swimlanes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
          'name'=>'required',
          'sortnumber'=>'required'
        ]);
        $swimlane = new Swimlane;
        $swimlane->name = $request->name;
        $swimlane->sortnumber = $request->sortnumber;

        $swimlane->save();
        return redirect('admin/swimlanes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Swimlane $swimlane)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Swimlane $swimlane)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Swimlane $swimlane)
    {
        
        $swimlane->update($request->all());

        $swimlane->save();

        return redirect('admin/swimlanes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Swimlane $swimlane)
    {
        $swimlane->delete();

        return redirect('admin/swimlanes');
    }

    public function increment(Swimlane $swimlane){
      $swimlane = Swimlane::find($swimlane->id);
      $swimlane->increment('sortnumber');
      $swimlane->save();
      return redirect('admin/swimlanes');
    }

    public function decrement(Swimlane $swimlane){
      $swimlane = Swimlane::find($swimlane->id);
      $swimlane->decrement('sortnumber');
      $swimlane->save();
      return redirect('admin/swimlanes');
    }
}
