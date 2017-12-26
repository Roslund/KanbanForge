<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BoardLog;

class BoardLogController extends Controller
{
    public function index()
    {
      // gets the latest 15 logged events.
      $events = BoardLog::join('users', 'users.id', '=', 'board_log.userId') ->select('board_log.*', 'users.username') ->orderBy('board_log.id', 'asc') ->take(15)->get();

      return view('stats.boardLog')->with(array('events' => $events));
    }
}
