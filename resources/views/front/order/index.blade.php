@extends('layout.app')  

<link rel="stylesheet" href="{{ asset('css/front-menu-list.css') }}">
<style>
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
            <div class="card  notob p-3">
                <div class="card-header  text-center">
                    <h3>ລາຍການແທງ</h3>
                </div>
                <div class="card-body p-1">
                    <div class="row">
                        @foreach($buy_order as $rx)
                        @php($display_text = '')
                        @if($rx->name == 'ABC')
                        @elseif($rx->name == 'WING')
                        @php($display_text = 'ວິ້ງ')
                        @elseif($rx->name == 'TWO')
                        @php($display_text = 'ເລກສອງໂຕ')
                        @elseif($rx->name == 'THREE')
                        @php($display_text = 'ເລກສາມໂຕ')
                        @elseif($rx->name == 'FOUR')
                        @php($display_text = 'ເລກສີ່ໂຕ')
                        @elseif($rx->name == 'FIVE')
                        @php($display_text = 'ເລກຫ້າໂຕ')
                        @elseif($rx->name == 'HIGHTLOW')
                        @php($display_text = 'ສູງຕໍ່າ')
                        @elseif($rx->name == 'KICKCOOL')
                        @php($display_text = 'ຄີກຄູ່')
                        @else
                        @endif

                        @php($display_text_2 = '')
                        @if($rx->type == 'UP')
                        @php($display_text_2 = 'ບົນ')
                        @elseif($rx->type == 'DOWN')
                        @php($display_text_2 = 'ລ່າງ')
                        @else
                        @endif

                        <div class="col-md-12 mb-3">
                            <div>
                                
                                <table class="table table-bordered custom-table"  style="border-radius: 10px !important;border: solid 1px black;">
                                    <thead>
                                        <tr>
                                            <td colspan="3"> 
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        ອໍເດີ້ : <label class="text-danger">#HK{{ $rx->id }}VIP</label><br>
                                                        ແທງ : {{ $display_text }} -- {{ $display_text_2 }}
                                                    </div>
                                                    <div>
                                                        ວັນທີ : {{ date('d-m-Y', strtotime($rx->created_at))}}<br>
                                                        ເວລາ : {{ date('H:i:s', strtotime($rx->created_at))}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="8%"></td>
                                            <td class="text-center">ໝາຍເລກ</td>
                                            <td class="text-center">ລາຄາ</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($total = 0)
                                        @php($count = 1)
                                        @foreach($rx->boHb as $r)
                                        @php($number = $r->number)

                                        @if($r->number == "HIGHT")
                                        @php($number = "ແທງສູງ")
                                        @elseif($r->number == "LOW")
                                        @php($number = "ແທງຕ່ຳ")
                                        @elseif($r->number == "KICK")
                                        @php($number = "ແທງຄີກ")
                                        @elseif($r->number == "COOL")
                                        @php($number = "ແທງຄູ່")
                                        @else
                                        @endif
                                        <tr>
                                            <td class="text-center">{{ $count++ }}</td>
                                            <td class="text-center">
                                                <u>{{ $number }}</u>
                                            </td>
                                            <td class="text-right">
                                                {{ number_format($r->price) }} ກີບ
                                            </td>
                                        </tr>
                                        @php($total += $r->price)
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right bg-danger text-white">
                                                ລວມມູນຄ່າ : {{ number_format($total) }} ກີບ
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            
                            </div>
                            <hr>
                        </div>
                        @endforeach
                    </div>
                    <div>
                        <div class="item-pagination d-flex justify-content-center">
                            {{ $buy_order->links('pagination.custom-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 
@endsection