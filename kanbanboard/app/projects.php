<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class projects extends Model
{
  protected $table = 'projects';
  protected $primaryKey = 'project_id';
  protected $fillable = ['project_id', 'createdBy','title', 'description'];

}
