<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Facility;
use DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *getAdd
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
    public function getList()
    {
        //$users = Users::where('role','!=', '0')->get();
        $users = Users::get();        
        return view('admin.usermanagement.users')
        ->with('page', 'all')
        ->with('users', $users);        
    }

    
    public function getAdd($userId = '', Request $request){        

        if($request != null && $request->has('email')){            
            if(true){
                $check = Users::where('email', $request->input('email'))->get();
                if(!$check->first()){                    
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
                        $last_name = $request->input('last_name');
                        $first_name = $request->input('first_name');                                        
                        $data = array_merge($request->all(), ['image' => 'uploads/user/'.$fileName  ]);                 
                        Users::create($data);

                    }else{
                        $last_name = $request->input('last_name');
                        $first_name = $request->input('first_name');                                        
                        $data = $request->all();
                        Users::create($data);
                    }

                
                }
                return redirect('user/list');                                
            }else{
                return redirect()->back();                
            }

        }else{
            return view('admin.usermanagement.add');
        }        
        
    }


    public function getEdit($userId = '', Request $request){

        $id = $request->input('id');
        if($request->has('name')){  

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
                Users::find($id)->update($data);

            }else{
                Users::find($id)->update($request->all());            
            }

            $user = Users::where('id', $id)->get();
            return view('admin.usermanagement.edit')->with('user', $user->first());                                
        }        

        $user = Users::where('id', $userId)->get();
        return view('admin.usermanagement.edit')->with('user', $user->first());
              
    }


    
}
