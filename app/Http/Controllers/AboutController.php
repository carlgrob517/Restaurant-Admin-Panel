<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use App\Facility;
use DB;

class AboutController extends Controller
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

    public function getList($userId = '' , Request $request){
        return redirect('about/edit');
    }

    public function getAdd($userId = '', Request $request){        
        if($request->has('title')){            
            About::create($request->all());
            return redirect('about/list');
        }else{
            return view('admin.notification.add');
        }        
    }


    public function getEdit($userId = '1', Request $request){

        $id =  1;// $request->input('id');
        if($request->has('title')){

            $fileName  = "";
            $file = $request->file('img');        
            if($file){

                $fileName =  $file->getClientOriginalName();            
                $extension = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();        
                $fileSize = $file->getSize();
                $fileMimeType = $file->getMimeType();                        
                $destinationPath = 'uploads/user';
                $file->move($destinationPath,$file->getClientOriginalName());            
                $data = array_merge($request->all(), ['image' => 'uploads/user/'.$fileName  ]);                 
                if($id != null && $id != ''){
                    About::find($id)->update($data);                
                }else{
                    About::create($request->all());                    
                }                
            }else{

                if($id != null && $id != ''){
                    About::find($id)->update($request->all());                
                }else{
                    About::create($request->all());
                }

            }
            
            $about = About::where('id', $id)->get();
            return view('admin.about.edit')->with('about', $about->first());                                
        }        

        


        $about = About::where('id', $id)->get();
        return view('admin.about.edit')->with('about', $about->first());
              
    }


    
}
