<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Restaurant extends Model
{
    //
    protected $table = 'restaurant';
    protected $fillable = array( 'id', 'title', 'description','image');

    public function categories() {        

        $restaurants = DB::table('category')
        ->select('restaurant_categories.id as id', 'category.name', 'category.sp_name', 'category.image')
        ->leftJoin('restaurant_categories', 'category.id', '=', 'restaurant_categories.category_id')
        ->where('restaurant_categories.restaurant_id' , $this->id)
        ->get();        
        return $restaurants;

    }
    public function hours() {  

        $restaurants = DB::table('hours')
        ->select('restaurant_hours.id as id', 'hours.start_time', 'hours.end_time', 'hours.week_of_day')
        ->leftJoin('restaurant_hours', 'hours.id', '=', 'restaurant_hours.hour_id')
        ->where('restaurant_hours.restaurant_id' , $this->id)
        ->get();
        //return ResHour::where('restaurant_id', $this->id)->get();        
        return $restaurants;
    }
    public function facilities() {        
        $restaurants = DB::table('facility')
        ->select('facility.id as id', 'facility.title', 'facility.image')
        ->leftJoin('restaurant_facility', 'facility.id', '=', 'restaurant_facility.facility_id')
        ->where('restaurant_facility.restaurant_id' , $this->id)
        ->get();

        return $restaurants;
        //return ResFacility::where('restaurant_id', $this->id)->get();        
    }

}
