<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    
    protected $fillable = ['name', 'limit', 'sortnumber', 'parentcategory'];

    
    public function getParentCategory() {
      
        $pk = DB::table('parent_categories')->where('id', $this->pk)->first();
      
        if($pk == null) return "";
        else  return $pk->name;
    }

}
