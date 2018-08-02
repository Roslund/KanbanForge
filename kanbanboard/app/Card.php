<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';
    protected $primaryKey = 'id';

    protected $fillable = ['artifact_id','category_id','swimlane_id'];
}
