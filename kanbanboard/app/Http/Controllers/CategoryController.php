<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        if(!Auth::check()) 
            return redirect('login');
        */

        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
        if(!Auth::check()) 
            return redirect('login');
        */
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        if(!Auth::check()) 
            return redirect('login');
        */

            $category = new Category;
            $category->name = $request->name;
            $category->limit = $request->limit;

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
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        /*if(!Auth::check()) 
            return redirect('login');
        */

        return view('admin.categories.edit', compact('category'));
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
        /*if(!Auth::check()) 
            return redirect('login');*/
        
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
        /*
        if(!Auth::check()) 
            return redirect('login'); */

        $category->delete();

        return redirect('admin/categories');
    }
}
