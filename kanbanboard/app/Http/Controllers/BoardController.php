<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Swimlane;
use App\Category;
use App\ParentCategory;

class BoardController extends Controller
{
  public function index()
  {
    $cards = Card::all();
    $categories = Category::orderBy('sortnumber', 'asc')->get();
    $swimlanes = Swimlane::orderBy('sortnumber', 'asc')->get();
    $parentCategories = ParentCategory::all()->keyBy('id');
    
    $data = array('cards' => $cards,
      'categories' => $categories,
      'swimlanes' => $swimlanes,
      'parentCategories' => $parentCategories);

    return view('board')->with($data);
  }
}
