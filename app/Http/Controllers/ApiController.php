<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Session;
use App\UserType;
use Response;
use DB;
use App\Category;
use App\SlideShow;
use App\Restaurant;
use App\Users;


use App\City;
use App\Oximeter;
use App\Blood;
use App\GSR;
use App\Allocation;
use App\Message;
use App\Company;
use App\Facility;

use DateTime;
use Config;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    // login api from device
    
    
    public function getBasic(Request $request){
        $slideshow = SlideShow::all();
        $categories = Category::all();
        
        $res = Restaurant::select('id', 'title', 'img', 'rate', 'phone')->limit(3)->get();        
        $pop = Restaurant::select('id', 'title', 'img')->limit(5)->get();

        $a = array('results'=>200,'slideshow'=>$slideshow, 'categories'=>$categories, 'res'=>$res, 'pop'=>$pop);        
        return Response::json($a);
    }

    public function getSlideshow(Request $request){
        $slideshow = SlideShow::where('status','1')->get();
        $a = array('results'=>200,'slideshow'=>$slideshow);
        return Response::json($a);        
    }
    
    public function getFilter(Request $request){

        $categories = Category::all();
        $facilities = Facility::all();
        $cities = City::all();

        $a = array('results'=>200,'categories'=>$categories, 'facilities'=>$facilities, 'cities'=>$cities);
        return Response::json($a);        
    }


    public function getCategories(Request $request){
        $cities = Category::all();
        $a = array('results'=>200,'categories'=>$cities);
        return Response::json($a);        
    }

    public function deleteCategory(Request $request){
        if($request != null){
            $id = $request->input('id');
            DB::delete('delete from category where id = ?',[$id]);     
        }
        $a = array('results'=>200);
        return Response::json($a);
    }

    public function deleteUser(Request $request){
        if($request != null){
            $id = $request->input('id');
            DB::delete('delete from users where id = ?',[$id]);     
        }
        $a = array('results'=>200);
        return Response::json($a);
    }
    public function deleteSlideshow(Request $request){
        if($request != null){
            $id = $request->input('id');
            DB::delete('delete from slideshow where id = ?',[$id]);     
        }
        $a = array('results'=>200);
        return Response::json($a);
    }
    
    public function deleteHour(Request $request){        
        $id = $request->input('id');    
        DB::delete('delete from hours where id = ?',[$id]);        
        $a = array('results'=>200);
        return Response::json($a);
    }
        
    public function getDeleteRestaurant(Request $request){        
        $id = $request->input('id');    
        DB::delete('delete from restaurant where id = ?',[$id]);        
        $a = array('results'=>200);
        return Response::json($a);
    }

    
    public function getDetails(Request $request){

        $id = $request->input('id');  
        if($id != null){
            
            $restaurants = Restaurant::where('id', $id)->get();
            foreach($restaurants as $res){
                $res['categories'] = $res->categories();
                $res['hours'] = $res->hours();
                $res['facilities'] = $res->facilities();
            }
                        
            $a = array('results'=>200,'restaurants'=>$restaurants->first());
            return Response::json($a);  
        }else{
            $a = array('results'=>400);
            return Response::json($a);  
        }            
    }



    public function getRestaurants(Request $request){

        $category_id = $request->input('category_id');       
        if($category_id != null){
            $restaurants = DB::table('restaurant')
            ->select('restaurant.id as id', 'rate', 'title', 'description','lat','lng',
             'address', 'email', 'img', 'review','favorite', 'restaurant.created_at')
            ->leftJoin('restaurant_categories', 'restaurant.id', '=', 'restaurant_categories.restaurant_id')
            ->where('restaurant_categories.category_id' , $category_id)
            ->where('restaurant.status' , 1)
            ->get();

            $a = array('results'=>200,'restaurants'=>$restaurants);
            return Response::json($a);  
        }else{
            $restaurants = Restaurant::select('restaurant.id as id', 'rate', 'title', 'description',
             'address', 'email', 'img', 'review','favorite', 'restaurant.created_at')
            ->leftJoin('restaurant_categories', 'restaurant.id', '=', 'restaurant_categories.restaurant_id')
            ->where('restaurant.status' , 1)
            ->get();
            
            foreach($restaurants as $res){
                $cat =  $res->categories();
                $msg = "";$i = 0;
                foreach($cat as $item){
                    if($i == 0){
                        $msg = $item->name;
                    }else{
                        $msg = $msg." & ".$item->name;
                    }    
                    $i++;                                
                }
                $res['cat_title'] = $msg;                
            }
            $a = array('results'=>200,'restaurants'=>$restaurants);
            return Response::json($a);  
        }

    }

    
    public function getSearch(Request $request){

        $category_id = $request->input('category_id');
        $city_id = $request->input('city_id');
        $city = [];
        if( $city_id != null){
            $city = explode(",", $city_id);            
        } 
        $min_price = $request->input('priceBegin');
        $max_price = $request->input('priceEnd');
        $rate = $request->input('rate');

        if($category_id != null){
            if($city_id == null || count($city) == 0){
                $restaurants = DB::table('restaurant')
                ->select('restaurant.id as id', 'rate', 'title', 'description','lat','lng',
                 'address', 'email', 'img', 'restaurant.created_at')
                ->leftJoin('restaurant_categories', 'restaurant.id', '=', 'restaurant_categories.restaurant_id')
                ->where('restaurant_categories.category_id' , $category_id)                
                ->where('restaurant.min_price' , '>=', (int)$min_price)
                ->where('restaurant.max_price' , '<=', (int)$max_price)
                ->where('restaurant.status' , 1)
                ->where('restaurant.rate' , $rate)
                ->get();
    
                $a = array('results'=>200,'restaurants'=>$restaurants);
                return Response::json($a);  
            }else{
                $restaurants = DB::table('restaurant')
                ->select('restaurant.id as id', 'rate', 'title', 'description','lat','lng',
                 'address', 'email', 'img', 'restaurant.created_at')
                ->leftJoin('restaurant_categories', 'restaurant.id', '=', 'restaurant_categories.restaurant_id')
                ->where('restaurant_categories.category_id' , $category_id)
                ->whereIn('restaurant.city_id' , $city)
                ->where('restaurant.min_price' , '>=', (int)$min_price)
                ->where('restaurant.max_price' , '<=', (int)$max_price)
                ->where('restaurant.rate' , $rate)
                ->where('restaurant.status' , 1)
                ->get();
    
                $a = array('results'=>200,'restaurants'=>$restaurants);
                return Response::json($a);  
            }
            
        }else{
            $a = array('results'=>400);
            return Response::json($a);  
        }
            
    }



    public function getCities(Request $request){
        
        $cities = City::all();
        $a = array('results'=>200,'cities'=>$cities);
        return Response::json($a); 
            
    }


    public function login(Request $request){        
        $email = $request->input('email');
        $password = $request->input('password');
        $token = $request->input('token');
        $check = Users::where('email', $email)
            ->where('password', $password)
            ->get();
        if($check->first()){
            if($token != null && $token != ""){
                DB::table('users')
                ->where('id', $check->first()->id)
                ->update(['remember_token' => $token]);                   
            }
            $a = array('results'=>200, 'id'=>$check->first()->id);
            return Response::json($a);
        }else{
            $a = array('results'=>400);
            return Response::json($a);
        }                
    }

    public function register(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = '3';

        $check = Users::where('email', $email)            
            ->get();
        if($check->first()){
            $a = array('results'=>400, 'msg'=>"exist user");
            return Response::json($a);
        }else{

            $users = new Users();
            $users->name = $name;
            $users->email = $email;
            $users->password = $password;
            $users->role = $role;
            $users->save();

            $a = array('results'=>200, 'id'=>$users->id);
            return Response::json($a);
        }  
                
    }

        
    public function deleteFacility(Request $request){        
        $id = $request->input('id');    
        DB::delete('delete from facility where id = ?',[$id]);        
        $a = array('results'=>200);
        return Response::json($a);
    }
            
    public function deleteNotification(Request $request){        
        $id = $request->input('id');    
        DB::delete('delete from notification where id = ?',[$id]);        
        $a = array('results'=>200);
        return Response::json($a);
    }
         
            
    public function deleteCity(Request $request){        
        $id = $request->input('id');    
        DB::delete('delete from city where id = ?',[$id]);        
        $a = array('results'=>200);
        return Response::json($a);
    }
    
    public function searchRestaurant(Request $request){

        $category_id = $request->input('category_id');
        $facility_id = $request->input('facility_id');
        $city_id = $request->input('city_id');
        $price = $request->input('price');
        $start_hour = $request->input('start_hour');
        $end_hour = $request->input('end_hour');
        $rate = $request->input('rate');

        // foreach ($request->input('hour_id') as $cId){
        // }

        $restaurants = DB::table('restaurant')
        ->select('restaurant.id as id', 'rate', 'title', 'description',
         'address', 'email', 'img', 'restaurant.created_at')
        ->leftJoin('restaurant_categories', 'restaurant.id', '=', 'restaurant_categories.restaurant_id')
        ->where('restaurant_categories.category_id' , $category_id)
        ->get();
        
        
    }

    public function updateStatus(Request $request){       

        $id = $request->input('id');
        $status = $request->input('status');        
            DB::table('restaurant')
            ->where('id', $id)
            ->update(['status' => $status]);           

        $aaa = array('results'=>200, 'data'=>$id);
        return Response::json($aaa);          
    }

    public function updateSlideStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');        
            DB::table('slideshow')
            ->where('id', $id)
            ->update(['status' => $status]);           

        $aaa = array('results'=>200, 'data'=>$id);
        return Response::json($aaa);          
    }
    




}
