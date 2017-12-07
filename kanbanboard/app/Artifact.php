<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{
  protected $table = 'artifacts';
  protected $primaryKey = 'id';
  protected $fillable = ['title','createdDate','status','description','assignedTo'];
}
