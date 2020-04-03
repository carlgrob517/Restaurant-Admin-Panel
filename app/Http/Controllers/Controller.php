<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use Response;
use DB;
use App\Users;
use App\UserType;
use App\Company;
use App\Ship;
use App\Bill;
use App\Country;
use App\State;
use App\City;
use App\Device;
use App\Allocation;
use App\GSR;

use Session;
use DateTime;
use App\Oximeter;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $BASELINE = 2;  // HAND
    public $SKIN = 3; // FOOT
    public $VALSA = 4;
    public $DEEPBREADING = 5;
    public $STANDING = 6;
    public $HANDGRIP = 7;

    function getWeekofday($index){

        switch($index){
            case 1:            
            return "Monday";
            case 2:
            return "Tuesday";
            case 3:
            return "Wendesday";
            case 4:
            return "Thursday";
            case 5:
            return "Friday";
            case 6:
            return "Saturday";
            case 7:
            return "Sunday";
        }        
    }


}
