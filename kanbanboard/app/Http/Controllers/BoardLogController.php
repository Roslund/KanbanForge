<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BoardLog;

class BoardLogController extends Controller
{
    public function index()
    {
      $events = BoardLog::join('users', 'users.id', '=', 'board_log.userId') ->select('board_log.*', 'users.username')->orderBy('board_log.id', 'desc')->limit(50)->get()->reverse();

      return view('stats.boardLog')->with(array('events' => $events));
    }
}
