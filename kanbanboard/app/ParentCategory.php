<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentCategory extends Model
{
    protected $table = 'parent_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

}
