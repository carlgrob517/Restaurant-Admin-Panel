<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\CommonHelper;
use App\Models\CommonWorker;
use App\Models\AdminWorker;
use Response;
use DB;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Mail;
use App\Mail\Send;

use App\Users;
use App\Category;
use App\Restaurant;
use App\SlideShow;
use App\ResImage;
use App\ResHour;
use App\ResCategory;
use App\Hour;
use App\Facility;
use App\ResFacility;
use App\City;

use Session;

class AdminController extends Controller
{    
    /**
     * Function for getting admin dashboard page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __construct()
    {
        
    }
    

    public function getIndex()
    {
        return view('admin.usermanagement.dashboard');
    }
    
    public function test(){
        $data = array(
            'name' => 'name',
            'message'=> 'message',
            'id'=>1
        );

        Mail::send('email', ["data"=>$data], function ($message)  {
                        $message->from('newuser@prohealthdetect.com', 'New User');
                        $message->subject('Create a new Account');
                        $message->to('kingstarboy@outlook.com');
                    });    
        //Mail::to('kingstarboy@outlook.com')->send(new Send($data));
        dd(Mail::failures());
        return json_encode($res);
                
    }
      
    
    // ------------------------------- Dashboard ---------------------------------
    public function getDashboard()
    {        
        return view('admin.dashboard.dashboard');        
    }


   
    // ----------------------------- Slide Show ------------------------------

    public function getSlideshow(){
        $slideshow = SlideShow::get();
        return view('admin.slideshow.lists')        
        ->with('slideshow', $slideshow);
    }
    public function getAddslideshow($id = '' , Request $request = null){

        if($request->has('title')){          
            $fileName  = "";
            $file = $request->file('img');  
            $title = $request->input('title');

            if($file){
                $fileName =  $file->getClientOriginalName();            
                $extension = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();        
                $fileSize = $file->getSize();
                $fileMimeType = $file->getMimeType();                        
                $destinationPath = 'uploads/slideshow';
                $file->move($destinationPath,$file->getClientOriginalName());   
            }

            $slideshow = new SlideShow();                
            $slideshow->title = $title;
            $slideshow->image = "uploads/slideshow/".$fileName;
            $slideshow->url = $request->input('url');
            if($request->input('status') == "on"){
                $slideshow->status = 1;
            }else{
                $slideshow->status = 0;
            }            
            $slideshow->save();             
            return redirect('admin/slideshow');

        }else{
            return view('admin.slideshow.add');
        }        
    }

    public function getEditslideshow($userId = '', Request $request){

        $id = $request->input('id');
        if($request->has('title')){
            
            $title = $request->input('title');              
            $file = $request->file('img'); 
            $url = $request->input('url');

            $fileName = "";
            if($file){
                $fileName =  $file->getClientOriginalName();            
                $extension = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();        
                $fileSize = $file->getSize();
                $fileMimeType = $file->getMimeType();                        
                $destinationPath = 'uploads/slideshow';
                $file->move($destinationPath,$file->getClientOriginalName());   
            }

            $status = 0;
            if($request->input('status') == "on"){
                $status = 1;
            }

            if($fileName != ""){                           
                DB::table('slideshow')
               ->where('id', $id)
               ->update(['image' => "uploads/slideshow/".$fileName, 'status'=>$status, 'title'=>$title, 'url'=>$url ]);                                          
            }else{
                DB::table('slideshow')
                ->where('id', $id)
                ->update(['title'=>$title ,'status'=>$status, 'url'=>$url ]);
            }   
            $slideshow = SlideShow::where('id', $id)->get();
            return view('admin.slideshow.edit')->with('slideshow', $slideshow->first());      

        }        

        $slideshow = SlideShow::where('id', $userId)->get();
        return view('admin.slideshow.edit')->with('slideshow', $slideshow->first());
              
    }


    // ----------------------- Category -----------------------------------------
    

    public function getCategory(){
        
        $categories = Category::get();

        foreach($categories as $cat){                       
            $cat['count'] = $cat->rescount();            
        }
        
        return view('admin.category.lists')
        ->with('page', 'all')
        ->with('categories', $categories);
    }

    public function getAddcategory($id = '' , Request $request = null){
        if($request->has('name')){          
            $fileName  = "";
            $file = $request->file('img');  
            $name = $request->input('name');
            $sp_name = $request->input('sp_name');

            if($file){
                $fileName =  $file->getClientOriginalName();            
                $extension = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();        
                $fileSize = $file->getSize();
                $fileMimeType = $file->getMimeType();                        
                $destinationPath = 'uploads/category';
                $file->move($destinationPath,$file->getClientOriginalName());   
            }
            $category = new Category();                
            $category->name = $name;
            $category->sp_name = $sp_name;
            $category->image = "uploads/category/".$fileName;            
            $category->save();             
            return redirect('admin/category');

        }else{
            return view('admin.category.add');
        }

    }
    public function getEditcategory($dirId = '', Request $request){
        
        
        $id = $request->input('id');
        if($request->has('name')){

            // get image
            $file = $request->file('img');  
            $name = $request->input('name');
            $sp_name = $request->input('sp_name');

            if($file){
                $fileName =  $file->getClientOriginalName();            
                $extension = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();        
                $fileSize = $file->getSize();
                $fileMimeType = $file->getMimeType();                        
                $destinationPath = 'uploads/category';
                $file->move($destinationPath,$file->getClientOriginalName());                               
                DB::table('category')
                ->where('id', $id)
                ->update(['name' => $name, 'sp_name' => $sp_name,  'image'=>'uploads/category/'.$fileName]);
            }else{
                DB::table('category')
                ->where('id', $id)
                ->update(['name' => $name, 'sp_name'=>$sp_name ]);
            }
                        
            $category = Category::where('id', $id)->get();
            return view('admin.category.edit')->with('category', $category->first());         
        }else{        
            $category = Category::where('id', $dirId)->get();        
            return view('admin.category.edit')
                    ->with('category', $category->first());    
        }
    }

    

    // -------------------- Rest  -----------------------------------------------
    public function getRestaurants(){
        $restaurants = Restaurant::where('company_id',Session::get('company_id'))->get();
        return view('admin.restaurant.lists')        
        ->with('restaurants', $restaurants);
    }
    public function getDeleteRestaurant($id = '', Request $request){        
        $id = $request->input('id');    
        DB::delete('delete from restaurant where id = ?',[$id]);        

        DB::delete('delete from restaurant_images where restaurant_id = ?',[$id]);        
        DB::delete('delete from restaurant_categories where restaurant_id = ?',[$id]);        
        DB::delete('delete from restaurant_hours where restaurant_id = ?',[$id]);        
        
        $a = array('results'=>200);
        return Response::json($a);
    }

    

    
    public function getAddrestaurant($pid, Request $request){

        if($request->has('title')){                           
           
            $title = $request->input('title');
            $desc = $request->input('desc');            
            $phone = $request->input('phone');
            $email = $request->input('email');  
            $fax = $request->input('fax');
            $url = $request->input('url');
            $pid = $request->input('pid');        
            $video = $request->input('video');   
            $lat = $request->input('lat');   
            $lng = $request->input('lng');
            $facebook = $request->input('facebook');
            $twitter = $request->input('twitter');
            $instagram = $request->input('instagram');
            $time = $request->input('time');
            $min_price = $request->input('min_price');
            $max_price = $request->input('max_price');            
            $favorite = 0;
            if($request->input('favorite') == "on"){
                $favorite = 1;    
            }            
            $slug = str_slug($title, '-');

            // file part
            $files = $request->file('img');
            $images = [];
            $fileName  = "";
            if($request->hasFile('img'))
            {
                foreach ($files as $file) {
                    //$file->store('users/' . $this->user->id . '/messages');
                    $fileName =  $file->getClientOriginalName();            
                    $extension = $file->getClientOriginalExtension();
                    $realPath = $file->getRealPath();        
                    $fileSize = $file->getSize();
                    $fileMimeType = $file->getMimeType();                        
                    $destinationPath = 'uploads/restaurant';
                    $file->move($destinationPath,$file->getClientOriginalName());
                    $img = 'uploads/restaurant/'.$fileName;//->input('img');
                    $images[] = $img;
                }
            }
                
                                                

            $category_id = "";
            if($request->input('category_id')){
                foreach($request->input('category_id') as $cId){                
                    $category_id = $category_id.":".$cId;                
                }
            }
            

            $hour_id = "";
            if($request->input('hour_id')){
                foreach($request->input('hour_id') as $hId){
                    $hour_id= $hour_id.":".$hId;
                }
            }

            $facility_id = "";
            if($request->input('facility_id')){
                foreach($request->input('facility_id') as $fId){
                    $facility_id= $facility_id.":".$fId;
                }
            }

            

            $check = Restaurant::where('title', $title)->get();
            if(!$check->first()){
                $business = new Restaurant();
                //On left field name in DB and on right field name in Form/view                
                $business->title = $title;
                $business->description = $desc;
                $business->img = 'uploads/restaurant/'.$fileName;  
                $business->address = $request->input('address');  
                $business->phone = $phone;  
                $business->email = $email;  
                $business->fax = $fax;  
                $business->url = $url;                
                $business->category_id = $category_id;
                $business->hour_id = $hour_id;
                
                $business->video  = str_replace('watch?v=', 'embed/', $video);
                $business->lat  = $lat;
                $business->lng  = $lng;
                $business->facebook  = $facebook;
                $business->twitter  = $twitter;
                $business->instagram  = $instagram;
                $business->time  = $time;
                $business->slug  = $slug;
                $business->company_id  = Session::get("company_id");
                $business->min_price  = $min_price;
                $business->max_price  = $max_price;
                $city_id = $request->input('city_id');
                $business->favorite  = $favorite;                
                $business->save();    
                
                // input business images                
                foreach ($images as $img){
                    $data = new ResImage();
                    $data->restaurant_id =  $business->id;
                    $data->image = $img;
                    $data->save();
                }

                // input business category infos.
                foreach ($request->input('category_id') as $cId){
                    $data = new ResCategory();
                    $data->restaurant_id =  $business->id;
                    $data->category_id = $cId;
                    $data->save();
                }

                // input hours of business
                foreach ($request->input('hour_id') as $hId){
                    $data = new ResHour();
                    $data->restaurant_id =  $business->id;
                    $data->hour_id = $hId;
                    $data->save();
                }

                foreach ($request->input('facility_id') as $fId){
                    $data = new ResFacility();
                    $data->restaurant_id =  $business->id;
                    $data->facility_id = $fId;
                    $data->save();
                }

            }
            
            $restaurants = Restaurant::all();
            return view('admin.restaurant.lists')
                ->with('restaurants', $restaurants);                
               
        }else{
            
            $categories = DB::table('category')->orderBy('name')->get();
            $hours = Hour::all();
            foreach($hours as $hour){
                $hour->week_of_day = $this->getWeekofday($hour->week_of_day);
            }

            $facilities  = Facility::all();
            $cities  = City::all();
                                
            return view('admin.restaurant.add')       
                    ->with('cities' , $cities)
                    ->with('facilities' , $facilities)
                    ->with('hours' , $hours)
                    ->with('categories', $categories);

        }        
    }


    public function getEditrestaurant($dirId = '', Request $request){
        
        $id = $request->input('id');
        if($request->has('title')){ 

            // get multiple images
            $files = $request->file('img');
            $images = [];
            if($request->hasFile('img'))
            {
                foreach ($files as $file) {
                    //$file->store('users/' . $this->user->id . '/messages');
                    $fileName =  $file->getClientOriginalName();            
                    $extension = $file->getClientOriginalExtension();
                    $realPath = $file->getRealPath();        
                    $fileSize = $file->getSize();
                    $fileMimeType = $file->getMimeType();                        
                    $destinationPath = 'uploads/restaurant';
                    $file->move($destinationPath,$file->getClientOriginalName());
                    $img = 'uploads/restaurant/'.$fileName;//->input('img');
                    $images[] = $img;
                }
            }
                                 
           
            $title = $request->input('title');
            $desc = $request->input('desc');    
            $address = $request->input('address');            
            $phone = $request->input('phone');
            $email = $request->input('email');  
            $fax = $request->input('fax');
            $url = $request->input('url');
            $vm = $request->input('video');
            $video  = str_replace('watch?v=', 'embed/', $vm);
            $lat = $request->input('lat');
            $lng = $request->input('lng');
            $time = $request->input('time');
            $facebook = $request->input('facebook');
            $twitter = $request->input('twitter');
            $instagram = $request->input('instagram');
            $min_price = $request->input('min_price');
            $max_price = $request->input('max_price');
            $city_id = $request->input('city_id');
            $favorite = 0;
            if($request->input('favorite') == "on"){
                $favorite = 1;    
            }  
            

            $category_id = "";
            foreach ($request->input('category_id') as $cId)
                 $category_id = $category_id.":".$cId;
            $hour_id = "";
            foreach($request->input('hour_id') as $hId){
                $hour_id= $hour_id.":".$hId;
            }

            $facility_id = "";
            if($request->input('facility_id') != null){
                foreach($request->input('facility_id') as $hId){
                    $facility_id= $facility_id.":".$hId;
                }
            }
            


            if(count($images) > 0){
                DB::table('restaurant')
                ->where('id', $id)
                ->update(['facebook' => $facebook,'twitter' => $twitter,'instagram' => $instagram,'time' => $time,'min_price' => $min_price,'max_price' => $max_price,'city_id' => $city_id,
                'lat' => $lat,'lng' => $lng,'url' => $url,'video' => $video,'title' => $title, 'description'=>$desc, 'favorite'=>$favorite, 
                'address'=> $address, 'img'=>$img, 'phone' => $phone,'email'=>$email, 'fax'=>$fax, 'category_id'=>$category_id, 'hour_id'=>$hour_id, 'facility_id'=>$facility_id]);
            }else{
                DB::table('restaurant')
                ->where('id', $id)
                ->update(['facebook' => $facebook,'twitter' => $twitter,'instagram' => $instagram,'min_price' => $min_price,'max_price' => $max_price,'city_id' => $city_id,
                'time' => $time,'lat' => $lat,'lng' => $lng,'url' => $url,'video' => $video,'title' => $title,  'favorite'=>$favorite, 
                'description'=>$desc, 'address'=> $address,  'phone' => $phone,'email'=>$email, 'fax'=>$fax, 'category_id'=>$category_id, 'hour_id'=>$hour_id, 'facility_id'=>$facility_id ]);
            }
                  
            if(count($images) > 0){
                DB::delete('delete from business_images where business_id = ?',[$id]);    
                foreach($images  as $img){
                    $bImage = new BusinessImages();
                    $bImage->business_id = $id;
                    $bImage->image = $img;
                    $bImage->save();
                }        
            }

            // initialize business category table and add new values
            DB::delete('delete from restaurant_categories where restaurant_id = ?',[$id]);            
            foreach ($request->input('category_id') as $cId){
                $data = new ResCategory();
                $data->restaurant_id = $id;
                $data->category_id = $cId;
                $data->save();
            }
            DB::delete('delete from restaurant_hours where restaurant_id = ?',[$id]);            
            foreach ($request->input('hour_id') as $cId){
                $data = new ResHour();
                $data->restaurant_id = $id;
                $data->hour_id = $cId;
                $data->save();
            }

            if($request->input('facility_id') != null){
                DB::delete('delete from restaurant_facility where restaurant_id = ?',[$id]);            
                foreach ($request->input('facility_id') as $cId){
                    $data = new ResFacility();
                    $data->restaurant_id = $id;
                    $data->facility_id = $cId;
                    $data->save();
                } 
            }
                       

            $user = Restaurant::where('id', $id)->get();
            $categories = Category::all();
            $myCats = ResCategory::where('restaurant_id', $id)->get();

            $hours = Hour::all();
            $myHour = ResHour::where('restaurant_id', $id)->get();

            $facilities = Facility::all();
            $myFacilities = ResFacility::where('restaurant_id', $id)->get();

            foreach($hours as $hour){
                $hour->week_of_day = $this->getWeekofday($hour->week_of_day);
            }
            foreach($myHour as $hour){
                $hour->week_of_day = $this->getWeekofday($hour->week_of_day);
            }
            
            $cities = City::all();

            return view('admin.restaurant.edit')
                    ->with('cities' , $cities)
                    ->with('hours' , $hours)
                    ->with('myHour' , $myHour)
                    ->with('categories' , $categories)
                    ->with('myCats' , $myCats)
                    ->with('facilities' , $facilities)
                    ->with('myFacilities' , $myFacilities)
                    ->with('directory', $user->first());

        }else{            
            $user = Restaurant::where('id', $dirId)->get();        
            $categories = DB::table('category')->orderBy('name')->get();
            $myCats = ResCategory::where('restaurant_id', $dirId)->get();   
            

            $hours = Hour::all();
            $myHour = ResHour::where('restaurant_id', $dirId)->get();

            $facilities  = Facility::all();
            $myFacilities = ResFacility::where('restaurant_id', $dirId)->get();

            foreach($hours as $hour){
                $hour->week_of_day = $this->getWeekofday($hour->week_of_day);
            }
            foreach($myHour as $hour){
                $hour->week_of_day = $this->getWeekofday($hour->week_of_day);
            }
            $cities = City::all();

            return view('admin.restaurant.edit')
                    ->with('cities' , $cities)
                    ->with('hours' , $hours)
                    ->with('myHour' , $myHour)
                    ->with('categories' , $categories)
                    ->with('myCats' , $myCats)
                    ->with('facilities' , $facilities)
                    ->with('myFacilities' , $myFacilities)
                    ->with('directory', $user->first());    
        }      
    }




    // ---------------------------------   Hours -----------------------------

    public function getHours(){        
        $users = Hour::all();
        return view('admin.hour.lists')->with('users', $users);
    }


    public function getEdithour($userId = '', Request $request){

        $id = $request->input('id');
        if($request->has('start_time')){

            $start_time = $request->input('start_time');
            $end_time = $request->input('end_time');  
            $week_of_day = $request->input('week_of_day');  

             DB::table('hours')
            ->where('id', $id)
            ->update(['start_time' => $start_time, 'end_time'=>$end_time, 'week_of_day'=>$week_of_day]);            
            
            $user = Hour::where('id', $id)->get();
            return view('admin.hour.edit')->with('user', $user->first());         
        }else{            
            $user = Hour::where('id', $userId)->get();
            return view('admin.hour.edit')->with('user', $user->first());
        }      
    }

    public function getAddhour($userId = '', Request $request){

        if($request->has('start_time')){

            $start_time = $request->input('start_time');
            $end_time = $request->input('end_time');  
            $week_of_day = $request->input('week_of_day');

            $check = Hour::where('start_time', $start_time)->where('end_time', $end_time)->where('week_of_day', $week_of_day)->get();
            if(!$check->first()){    
                $user = new Hour();
                //On left field name in DB and on right field name in Form/view
                $user->start_time = $start_time;
                $user->end_time = $end_time;       
                $user->week_of_day = $week_of_day;       
                $user->save();    
            }              
            $users = Hour::all();
            return view('admin.hour.lists')->with('users', $users);
        }else{
            return view('admin.hour.add');
        }        
    }

        

    // ---------------------------------   Facilities -----------------------------

    public function getFacility(){        
        $facilities = Facility::all();
        return view('admin.facility.lists')->with('facilities', $facilities);
    }


    public function getEditfacility($userId = '', Request $request){

        $id = $request->input('id');
        if($request->has('title')){
            
            $title = $request->input('title');              
            $file = $request->file('image'); 
            $fileName = "";
            if($file){
                $fileName =  $file->getClientOriginalName();            
                $extension = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();        
                $fileSize = $file->getSize();
                $fileMimeType = $file->getMimeType();                        
                $destinationPath = 'uploads/facility';
                $file->move($destinationPath,$file->getClientOriginalName());   
            }

            if($fileName != ""){
                           
                DB::table('facility')
               ->where('id', $id)
               ->update(['image' => "uploads/facility/".$fileName, 'title'=>$title ]);            
               
               $facility = Facility::where('id', $id)->get();
               return view('admin.hour.edit')->with('facility', $facility->first());      
            }              
        }        

        $facility = Facility::where('id', $userId)->get();
        return view('admin.facility.edit')->with('facility', $facility->first());
              
    }

    public function getAddfacility($userId = '', Request $request){
        
        if($request->has('title')){
            $title = $request->input('title');
            $file = $request->file('img'); 
            $fileName = "";            
            if($file){
                $fileName =  $file->getClientOriginalName();            
                $extension = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();        
                $fileSize = $file->getSize();
                $fileMimeType = $file->getMimeType();                        
                $destinationPath = 'uploads/facility';
                $file->move($destinationPath,$file->getClientOriginalName());   
            }
            
            $facility = new Facility();
            $facility->title = $title;            
            $facility->image = "uploads/facility/".$fileName;            
            $facility->save();

            return redirect('admin/facility');
        }else{
            return view('admin.facility.add');
        }        
    }


        
}
