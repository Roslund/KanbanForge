<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
  protected $table = 'project';
  protected $primaryKey = 'project_id';
  protected $fillable = ['project_id', 'createdBy','title', 'description'];

}
