<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardLog extends Model
{
    protected $table = 'board_log';
    public $incrementing = false;
    protected $fillable = ['userId', 'eventType', 'message'];

    public static function logBoardEvent($userId, $eventType, $message)
    {
      BoardLog::create([
        'userId' => $userId,
        'eventType' => $eventType,
        'message' => $message
      ]);
    }
}
