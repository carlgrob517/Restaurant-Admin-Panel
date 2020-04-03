<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Facility;
use App\Users;
use DB;
use Response;

class NotificationController extends Controller
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
    public function getList()
    {
        $notifications = Notification::all();
        return view('admin.notification.lists')->with('notifications', $notifications);
    }

    public function getAdd($userId = '', Request $request){        
        if($request->has('title')){            
            Notification::create($request->all());
            return redirect('notification/list');
        }else{
            return view('admin.notification.add');
        }        
    }



    public function getEdit($userId = '', Request $request){
        $id = $request->input('id');
        if($request->has('title')){
            Notification::find($id)->update($request->all());            
            $notifications = Notification::where('id', $id)->get();
            return view('admin.notification.edit')->with('notification', $notifications->first());                                
        }
        $notification = Notification::where('id', $userId)->get();
        return view('admin.notification.edit')->with('notification', $notification->first());              
    }
        
    public function getSend($userId = '' , Request $request){        
        $nid = $request->input('notification_id');
        $device_id = Users::select('remember_token')->where('role', '3')->get();
        $notification = Notification::where('id',$nid)->get();     
        if($notification->first()){
            $dID = [];
            foreach($device_id as $item){
                if($item->remember_token != null){
                    $dID[] = $item->remember_token;
                }                
            }
            $res = $this->push_notification_android($dID, $notification->first() );
            $a = array('results'=>200, 'msg'=>$res);
            return Response::json($a); 
        }
        $a = array('results'=>400);
        return Response::json($a); 



    }

    function push_notification_android($device_id,$message){
       

        //API URL of FCM
        $url = 'https://fcm.googleapis.com/fcm/send';    
        /*api_key available in:
        Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/    $api_key = 'AAAAoVQ28qY:APA91bFDlpgcktiynn_syX19B4vKy86nlel3PFTLrRByfGDD3rWZl41P3LUjnoUW5Q8zJ7GKLObU-phdRAM1IPtlhi3wX7DvahYTsvnhqutt49U5zr_Rrn0Hd5d0V27hkrc2vyP1eKXo';
        $registrationIds = array( 'ecggAR6eUn8:APA91bFSftbDr7s4MtUTYM7U37RygTBA8IZZRDVpyjd6MM2S6oLVPTONz_DkvZtzvTgJ0c__WH5R7MXwjt5CT3taj11AIcR3Cvahsa-9fZKRK38eJn38VdXCMvIIUvIG-sj_bJ4IQxFI' );

        $fields = array (
            'registration_ids' =>$registrationIds,
            'notification' => array (
                    "message" => $message->description,
                    'title'		=> $message->title,
                    'url' =>$message->url
            )
        );

        //return $fields;

    
        //header includes Content type and api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$api_key
        );
                    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));            
        }
        curl_close($ch);
        return $result;

        // $data = array("to" => $registrationIds, "notification" => array( "title" => "Shareurcodes.com", "body" => "A Code Sharing Blog!","icon" => "icon.png", "click_action" => "http://shareurcodes.com")); 
        // $data_string = json_encode($data); 
        
        // $headers = array ( 'Authorization: key=' . $api_key, 'Content-Type: application/json' ); 
        // $ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' ); 
        // curl_setopt( $ch,CURLOPT_POST, true ); 
        // curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers ); 
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSLVERSION, 3);        
        // curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string); 
        // $result = curl_exec($ch); 

        // if ($result === FALSE) {
        //     die('FCM Send Error: ' . curl_error($ch));            
        // }
        // curl_close ($ch); 
        // return $result;

    }
        
}
