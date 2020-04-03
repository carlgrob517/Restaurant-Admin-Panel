<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected $table = 'category';
    protected $fillable = array( 'id', 'name', 'desc','image');
    
    public function rescount() {
        
            return ResCategory::where('category_id', $this->id)->count();
            //return $this->hasMany(ResCategory::class);
            //return $this->belongsToMany(ResCategory::class, 'restaurant_categories', 'category_id');                
    }

}
