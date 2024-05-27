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

class BuyController extends Controller
{
    public function index($index)
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
                    WHERE c.id IN ('". $user_id ."') AND t.status = 'SUCCESS'  GROUP BY c.name;            
            ");   
           
            if($money)
            {
                $money = $money[0]->current_money;
            }
            else
            {
                $money=0;
            } 
            $gain_number = 0;
            $head_menu = '';

            if($index=='W')
            { 
                $gain_number = 1;
                $head_menu = 'ເລກວິ້ງ';
            }
            elseif($index=='T')
            {
                $gain_number = 2;
                $head_menu = 'ເລກສອງໂຕ'; 
            }
            elseif($index=='TH')
            {
                $gain_number = 3;
                $head_menu = 'ເລກສາມໂຕ'; 
            }
            elseif($index=='F')
            {
                $gain_number = 4;
                $head_menu = 'ເລກສີ່ໂຕ'; 
            }
            elseif($index=='FV')
            {
                $gain_number = 5;
                $head_menu = 'ເລກຫ້າໂຕ'; 
            }
            else
            {

                $gain_number = 0;
                $head_menu = '';
            }

            return view('front.buy.index')->with('money',$money)->with('gain_number',$gain_number)
            ->with('head_menu',$head_menu);
        // }
        // else
        // {
            
        //     return view('front.buy.index')->with('money',0.00); 
        // } 
    }

    public function buy(Request $request,$gain_number)
    {
       

        $custom_data = $request->custom_data;
        $pick_type = $request->pick_type;
        $data = $request->data;
        $name = '';
        if($gain_number=='1')
        {
            $name = 'WING';
        }
        elseif($gain_number=='2')
        {
            $name = 'TWO'; 
        }
        elseif($gain_number=='3')
        {
            $name = 'THREE';  
        }
        elseif($gain_number=='4')
        {
            $name = 'FOUR';   
        }
        elseif($gain_number=='5')
        {
            $name = 'FIVE';    
        }
        elseif($gain_number=='69')
        {
            $name = 'HIGHTLOW';    
        }
        elseif($gain_number=='12')
        {
            $name = 'KICKCOOL';    
        }
        else
        {

        }
      
        $box_id = box::where('status','BUYING')->first();
        if($box_id)
        {

        }
        else
        { 
            return response()->json(['status' => 'CLOSED']);
        }
        $user_id = 1;

        $buy_order = new buy_order;
        $buy_order->user_id = $user_id;
        $buy_order->name = $name;
        $buy_order->type = $pick_type;
        $buy_order->percent = '10';
        $buy_order->total_price = '0';
        $buy_order->box_id = $box_id->id;
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
            $number = $r['number'];
            if($r['number']=="ແທງສູງ")
            {
                $number = "HIGHT";
            }
            elseif($r['number']=="ແທງຕ່ຳ")
            {
                $number = "LOW"; 
            }
            elseif($r['number']=="ແທງຄີກ")
            {
                $number = "KICK"; 
            }
            elseif($r['number']=="ແທງຄູ່")
            {
                $number = "COOL"; 
            }
            else
            {

            }
            $buy = new buy;
            $buy->buy_order = $buy_order->id;
            $buy->user_id = $user_id;
            $buy->number = $number;
            $buy->price = $price;
            // $buy->price = '1000';
            $buy->type = $pick_type;
            $buy->box_id =  $box_id->id;
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
        $wallet_transaction->type = "Purchase"; 
        $wallet_transaction->sort = $buy_order->id;
        $wallet_transaction->created_at = Carbon::now('Asia/Bangkok');
        $wallet_transaction->save();


        // dd($custom_data, $pick_type,$data);
        return response()->json(['order' => $buy_order->id,'status' => 'DONE']);

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


    public function hightlow()
    {
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
                    WHERE c.id IN ('". $user_id ."') AND t.status = 'SUCCESS'  GROUP BY c.name;            
            ");   
           
            if($money)
            {
                $money = $money[0]->current_money;
            }
            else
            {
                $money=0;
            } 
            $gain_number = 69;
            $head_menu = 'ສູງຕໍ່າ';

            return view('front.buy.hightlow')->with('money',$money)->with('gain_number',$gain_number)
            ->with('head_menu',$head_menu);
    }

    
    public function kickcool()
    {
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
                    WHERE c.id IN ('". $user_id ."') AND t.status = 'SUCCESS'  GROUP BY c.name;            
            ");   
           
            if($money)
            {
                $money = $money[0]->current_money;
            }
            else
            {
                $money=0;
            } 
            $gain_number = '12';
            $head_menu = 'ຄີກຄູ່';

            return view('front.buy.hightlow')->with('money',$money)->with('gain_number',$gain_number)
            ->with('head_menu',$head_menu);
    }

}
