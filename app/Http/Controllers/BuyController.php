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
class BuyController extends Controller
{
    public function index()
    {
        return view('front.buy.index');
    }

    public function buy(Request $request)
    {

        $custom_data = $request->custom_data;
        $pick_type = $request->pick_type;
        $data = $request->data;

        $name = 'WING';
        $box_id = 1;
        $user_id = 1;

        $buy_order = new buy_order;
        $buy_order->user_id = $user_id;
        $buy_order->name = $name;
        $buy_order->type = $pick_type;
        $buy_order->percent = '10';
        $buy_order->total_price = '0';
        $buy_order->box_id = $box_id;
        $buy_order->created_at = Carbon::now('Asia/Bangkok');
        $buy_order->save();

        // 0 => array:2 [
        //     "number" => "1"
        //     "price" => null
        //   ]
        $total = 0;
        foreach($data as $r)
        {
            // dd($r['number'],$r['price']);
            $buy = new buy;
            $buy->buy_order = $buy_order->id;
            $buy->user_id = $user_id;
            $buy->number = $r['number'];
            // $buy->price = $r['price'];
            $buy->price = '1000';
            $buy->type = $pick_type;
            $buy->box_id =  $box_id;
            $buy->created_at = Carbon::now('Asia/Bangkok');
            $buy->save();
            // $total += $r['price'];
            $total += 1000;
        }
        $buy_order->total_price = $total;
        $buy_order->save();


        // dd($custom_data, $pick_type,$data);
        return response()->json(['request' => $request]);

    }
}
