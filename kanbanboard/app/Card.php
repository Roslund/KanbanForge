<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['artifact_id', 'category_id', 'swimlane_id'];
}
