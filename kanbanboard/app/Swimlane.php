<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swimlane extends Model
{
    protected $table = 'swimlanes';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'sortnumber'];
}
