<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{
  protected $table = 'artifacts';
  protected $primaryKey = 'id';
  protected $foreignKey= 'projectId';
  protected $fillable = ['title', 'createdDate','status', 'description','assignedTo'];
}
