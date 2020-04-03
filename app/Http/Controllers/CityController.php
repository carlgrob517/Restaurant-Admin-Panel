<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Facility;
use DB;

class CityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        $cities = City::all();
        return view('admin.city.lists')->with('cities', $cities);
    }

    
    public function getCity(){        
        $cities = City::all();
        return view('admin.city.lists')->with('cities', $cities);
    }


    public function getEditcity($userId = '', Request $request){

        $id = $request->input('id');
        if($request->has('city_name')){
            
            $title = $request->input('city_name');              
            
            DB::table('city')
            ->where('id', $id)
            ->update(['city_name'=>$title ]);            
            
            $city = City::where('id', $id)->get();
            return view('admin.city.edit')->with('city', $city->first());                                
        }        

        $city = City::where('id', $userId)->get();
        return view('admin.city.edit')->with('city', $city->first());
              
    }

    public function getAddcity($userId = '', Request $request){
        
        if($request->has('city_name')){
            $title = $request->input('city_name');
            
            $facility = new City();
            $facility->city_name = $title; 
            $facility->county_fips = ''; 
            $facility->state_id = '50';             
            $facility->save();

            return redirect('city/index');
        }else{
            return view('admin.city.add');
        }        
    }

    
}
