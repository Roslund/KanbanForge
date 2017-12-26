<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardLog extends Model
{
    protected $table = 'board_log';
    public $incrementing = false;
    protected $fillable = ['userId', 'eventType', 'message'];
}
