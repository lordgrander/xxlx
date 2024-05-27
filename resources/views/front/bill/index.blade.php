@extends('layout.app')  

<link rel="stylesheet" href="{{ asset('css/front-menu-list.css') }}"><style>
    .custom-table {
    max-width: 50%;
    margin: auto;
}

.custom-table td,
.custom-table th {
    vertical-align: middle;
    text-align: center;
    font-size: 14px;
}

@media (max-width: 768px) {
    .custom-table {
        max-width: 100%;
        min-width: 100%;
    }

    .custom-table td,
    .custom-table th {
        font-size: 12px;
    }
}

.custom-table .text-right {
    text-align: right;
}
</style>
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
                            @elseif($buy_order->name=='TWO')
                                @php($display_text = 'ເລກສອງໂຕ') 
                            @elseif($buy_order->name=='THREE')
                                @php($display_text = 'ເລກສາມໂຕ') 
                            @elseif($buy_order->name=='FOUR')
                                @php($display_text = 'ເລກສີ່ໂຕ') 
                            @elseif($buy_order->name=='FIVE')
                                @php($display_text = 'ເລກຫ້າໂຕ') 
                            @elseif($buy_order->name=='HIGHTLOW')
                                @php($display_text = 'ສູງຕໍ່າ') 
                            @elseif($buy_order->name=='KICKCOOL')
                                @php($display_text = 'ຄີກຄູ່') 
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
                        <table class="  table table-bordered custom-table mt-2" width="50%"  style="border-radius: 10px !important;border: solid 1px black;">
                            <thead> 
                                <tr>
                                    <td width="8%"></td>
                                    <td class="text-center">ໝາຍເລກ</td>
                                    <td class="text-center">ລາຄາ</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total=0)
                                @php($count=1)
                                @foreach($buy AS $r)
                                    @php($number = $r->number)
                                    
                                    @if($r->number=="HIGHT") 
                                        @php($number = "ແທງສູງ")
                                    @elseif($r->number=="LOW") 
                                        @php($number = "ແທງຕ່ຳ")
                                    @elseif($r->number=="KICK") 
                                        @php($number = "ແທງຄີກ")
                                    @elseif($r->number=="COOL") 
                                        @php($number = "ແທງຄູ່" )
                                    @else
                                      
                                    @endif
                                    <tr> 
                                        <td class="text-center">{{$count++}}</td>
                                        <td class="text-center">
                                            <u>{{$number}}</u>
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
                                    <td colspan="3" class="text-right bg-danger text-white">
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