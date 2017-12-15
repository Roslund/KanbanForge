<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use Auth;

use DB;
use PDO;

class CategoryController extends Controller
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
        $categories = Category::orderBy('sortnumber', 'asc')->paginate(20);
        $parent_categories = DB::table('parent_categories')->pluck('name', 'id');

        return view('admin.categories.index',compact(['categories', 'parent_categories']));
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
              'limit'=>'required',
              'sortnumber'=>'required'
            ]);
            $category = new Category;
            $category->name = $request->name;
            $category->limit = $request->limit;
            $category->sortnumber = $request->sortnumber;

            $category->save();
            return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        
        $category->update($request->all());

        $category->save();


        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('admin/categories');
    }

    public function increment(Category $category){
      $category = Category::find($category->id);
      $category->increment('sortnumber');
      $category->save();
      return redirect('admin/categories');
    }

    public function decrement(Category $category){
      $category = Category::find($category->id);
      $category->decrement('sortnumber');
      $category->save();
      return redirect('admin/categories');
    }
}
