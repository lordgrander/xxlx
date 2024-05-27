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

class BuyController extends Controller
{
    public function index()
    {
        // if(session('user_id'))
        // {  
            $money = 0;
            // $user_id = session('user_id');
            $user_id = '1';
            $money = DB::select("SELECT 
                    c.name AS customer_name, 
                    SUM( CASE WHEN t.type = 'Deposit'
                        THEN t.amount WHEN t.type = 'Win' 
                        THEN t.amount WHEN t.type = 'Withdrawal' 
                        THEN t.amount WHEN t.type = 'Purchase' 
                        THEN t.amount ELSE 0 END 
                    ) AS current_money 
                    FROM users c 
                    JOIN wallet_transaction t 
                    ON c.id = t.user_id 
                    WHERE c.id IN ('". $user_id ."') AND t.status = 'Success'  GROUP BY c.name;            
            ");   
           
            if($money)
            {
                $money = $money[0]->current_money;
            }
            else
            {
                $money=0;
            } 
            $gain_number = 1;

            return view('front.buy.index')->with('money',$money)->with('gain_number',$gain_number);
        // }
        // else
        // {
            
        //     return view('front.buy.index')->with('money',0.00); 
        // } 
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
            $price = str_replace(',','',$r['price']); 
            // dd($r['number'],$r['price']);
            $buy = new buy;
            $buy->buy_order = $buy_order->id;
            $buy->user_id = $user_id;
            $buy->number = $r['number'];
            $buy->price = $price;
            // $buy->price = '1000';
            $buy->type = $pick_type;
            $buy->box_id =  $box_id;
            $buy->created_at = Carbon::now('Asia/Bangkok');
            $buy->save();
            // $total += $r['price'];
            $total += $price;
        }




        $buy_order->total_price = $total;
        $buy_order->save();


        $wallet_transaction = new wallet_transaction;
        $wallet_transaction->user_id = $user_id;
        $wallet_transaction->status = "SUCCESS";
        $wallet_transaction->amount = '-' . $total;
        $wallet_transaction->type = "Withdrawal"; 
        $wallet_transaction->sort = $buy_order->id;
        $wallet_transaction->created_at = Carbon::now('Asia/Bangkok');
        $wallet_transaction->save();


        // dd($custom_data, $pick_type,$data);
        return response()->json(['order' => $buy_order->id]);

    }

    
    public function bill($id)
    {
       $user_id = 1;
       $buy = buy::where('user_id', $user_id)->where('buy_order',$id)->get();
       $buy_order = buy_order::where('user_id', $user_id)->where('id',$id)->first();
       if($buy)
       { 
        return view('front.bill.index',compact('buy','buy_order')); 
       }
       else
       {

       }
    }

}
