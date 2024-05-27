<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
 

use Illuminate\Support\Str; Use Hash; 
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Carbon\carbon;
use Carbon\CarbonTimeZone;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

Use App\Models\buy;
Use App\Models\buy_order;
Use App\Models\wallet_transaction;
Use App\Models\Users;
Use App\Models\box;

class OrderController extends Controller
{
    public function index()
    {  
        $user_id = 1; 
        $buy_order = buy_order::where('user_id', $user_id)->orderby('id','DESC')->paginate(20, ['*'], 'page_name') ;
        return view('front.order.index',compact('buy_order'));
    }
}
