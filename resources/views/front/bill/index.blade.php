@extends('layout.app')  

<link rel="stylesheet" href="{{ asset('css/front-menu-list.css') }}">
@section('content')  
<div class="container">
     <div class="row"> 
        
        <div class="col-12 mt-2">
            <div class="card notob p-3">
                <div class="card-header text-center"> 
                    <h3>ການແທງຫວຍສຳເລັດ</h3>
                </div>
                <div class="card-body p-1  "> 
                    <div class="text-center"> 
                        <div>
                            @php($display_text = '')
                            @if($buy_order->name=='ABC')
                            @elseif($buy_order->name=='WING')
                                @php($display_text = 'ວິ້ງ') 
                            @else
                            
                            @endif

                            
                            @php($display_text_2 = '')
                            @if($buy_order->type=='UP')
                                @php($display_text_2 = 'ບົນ') 
                            @elseif($buy_order->type=='DOWN')
                                @php($display_text_2 = 'ລ່າງ') 
                            @else
                            
                            @endif
                            ອໍເດີ້ : #HK{{ $buy_order->id }}VIP |
                            ວັນທີ : {{ date('d-m-Y',strtotime($buy_order->created_at))}} |
                            ເວລາ : {{ date('H:i:s',strtotime($buy_order->created_at))}} |
                            ແທງ : {{ $display_text }} -- {{ $display_text_2 }}
                        </div>
                        <table class="  table  " width="50%">
                            <thead> 
                                <tr>
                                    <td class="text-center">ໝາຍເລກ</td>
                                    <td class="text-center">ລາຄາ</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total=0)
                                @foreach($buy AS $r)
                                    <tr> 
                                        <td class="text-center">
                                            <u>{{$r->number}}</u>
                                        </td> 
                                        <td class="text-right"> 
                                            {{number_format($r->price)}} ກີບ
                                        </td>
                                    </tr> 
                                    @php($total+=$r->price)

                                @endforeach
                            </tbody>
                            <tfoot> 
                                <tr>
                                    <td colspan="2" class="text-right">
                                        ລວມມູນຄ່າ : {{number_format($total)}} ກີບ
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <div>
                            <a href="/">
                                <button class="btn btn-outline-dark form-control">ກັບໜ້າຫຼັກ</button> 
                            </a>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>  
         
     </div>
</div>
 
@endsection