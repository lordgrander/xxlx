@extends('layout.app')  

<link rel="stylesheet" href="{{ asset('css/front-menu-list.css') }}">
@section('content')  
<div class="container">
     <div class="row"> 
        
        <div class="col-12 mt-2">
            <div class="card notob p-3">
                <div class="card-header text-center"> 
                    <h3>{{ $head_menu }}</h3>
                </div>
                <div class="card-body p-1 d-flex"> 
                    <table class="table   ">
                        <thead> 
                        </thead>
                        <tbody>
                            <tr> 
                                <td class="text-center">
                                    <input type="text" class="form-control simple-input" id="inputValues" placeholder="ປ້ອນເລກ" value="1,2,3,4,5,6,7,8,9"  >
                                </td>
                                <td class="text-right"> 
                                    <input type="text" class="form-control simple-input" placeholder="ຈຳນວນເງິນ" id="set_price"  onkeyup="javascript:this.value=Comma(this.value);">
                                </td> 
                                <td>
                                    <button class="btn btn-danger" id="goButton">Go</button>
                                </td>
                            </tr> 
                        </tbody>
                        <tfoot> 
                        </tfoot>
                    </table>   
                </div> 
            </div> 
        </div> 
        <div class="col-12 mt-2">
            <div class="card notob p-3">
                <table class="table table-bordered table-hover  ">
                    <thead>
                        <tr> 
                            <th class="text-center"  width="8%"></th>
                            <th class="text-center">ໝາຍເລກ</th>
                            <th class="text-center">ຈຳນວນເງິນ</th>  
                            <th class="text-center"></th>  
                        </tr>
                    </thead>
                    <tbody id="numberInputsContainer">
                    </tbody>
                    <!-- <tfoot id="badnumberInputsContainer"> 
                    </tfoot> -->
                </table> 
            </div>
        </div>
        
        <div class="col-12 mt-2">
            <div class="card notob"> 
                <div class="p-3">
                    <div>
                        <h5 class="text-danger">1. ຕັ້ງລາຄາ :</h5>
                            <button class="btn btn-outline-dark set-all" data-id="1K">1K</button>
                            <button class="btn btn-outline-dark set-all" data-id="5K">5K</button>
                            <button class="btn btn-outline-dark set-all" data-id="10K">10K</button>
                            <button class="btn btn-outline-dark set-all" data-id="20K">20K</button>
                            <button class="btn btn-outline-dark set-all" data-id="50K">50K</button>
                            <button class="btn btn-outline-dark set-all" data-id="100K">100K</button>
                            <button class="btn btn-outline-dark set-all" data-id="500K">500K</button>
                            <button class="btn btn-outline-dark set-all" data-id="1000">1,000K</button>
                    </div>
                    <hr>
                    <div>
                        <h5 class="text-danger">2. ເລືອກແທງ :</h5>
                        <select name="pick_type" id="pick_type" class="w-100 btn btn-outline-dark">
                            <option value="UP">ແທງບົນ</option>
                            <option value="DOWN">ແທງລ່າງ</option>
                        </select> 
                    </div>
                    <hr>
                    <div>
                        <h5 class="text-danger">3. ຍອດລວມ :</h5> 
                        <div class="d-flex justify-content-between">
                            <div>
                                ຍອດເງິນເຄຣດີທ : {{ number_format($money) }} ກີບ
                            </div>
                            <div>
                                <span id="display_total">ລວມ  : 0 ກີບ</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-3">
                    <button id="submit_data" class="btn btn-danger w-100">Go</button> 
                </div>
            </div>
        </div>
     </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#inputValues').focus();

            $('.set-all').click(function() {
                let set = $(this).attr('data-id');
                 
                if(set=='1K')
                {
                    $('.price').val(number_format('1000', '', '', ','));
                }
                else if(set=='5K')
                {
                    $('.price').val(number_format('5000', '', '', ','));
                }
                else if(set=='10K')
                {
                    $('.price').val(number_format('10000', '', '', ','));
                }
                else if(set=='20K')
                {
                    $('.price').val(number_format('20000', '', '', ','));
                }
                else if(set=='50K')
                {
                    $('.price').val(number_format('50000', '', '', ','));
                }
                else if(set=='100K')
                {
                    $('.price').val(number_format('100000', '', '', ','));
                }
                else if(set=='500K')
                {
                    $('.price').val(number_format('500000', '', '', ','));
                }
                else if(set=='1000')
                {
                    $('.price').val(number_format('1000000', '', '', ','));
                }
                else
                {
                    $('.price').val('');
                }
                cacu_total();
            });
            $('#goButton').click(function() {
                var inputValues = $('#inputValues').val();
                var set_price = $('#set_price').val();
                var numberInputsContainer = $('#numberInputsContainer'); 
                var validNumber = {{ $gain_number }}; 
        
                numberInputsContainer.empty(); 
        
                var numbers = inputValues.match(/-?\d+(\.\d+)?/g);

                if (numbers) {
                    var count = 1;
                    $.each(numbers, function(index, number) { 
                        var inputField = `<input type="number" class="form-control number-input text-center simple-input number" value="${number}">`;
                        
                        let box = ` 
                            <tr> 
                                <td class="text-center">
                                    ${count++}
                                </td>
                                <td class="text-center">
                                    ${inputField}
                                </td>
                                <td class="text-right"> 
                                    <input type="text" class="form-control simple-input price text-right" value="${number_format (set_price, '', '', ',') }"  onkeyup="javascript:this.value=Comma(this.value);">
                                </td>  
                                <td class="text-center">
                                    <button class="btn btn-danger btn-delete">
                                        X
                                    </button>
                                </td>
                            </tr> 
                        `;

                        if (number.length > validNumber) {  
                        } else { 
                            numberInputsContainer.append(box);
                        }
                    });
                } else {
                    alert('No valid numbers found in the input.');
                }

                        // Add event listener for number inputs to restrict to 1 digit
                numberInputsContainer.on('keyup', '.number-input', function() {
                    let value = $(this).val();
                    if (value.length > {{ $gain_number }}) {
                        $(this).val(value.substring(0, 1));
                    }
                });
            });

            // Add event listener for delete buttons
            $(document).on('click', '.btn-delete', function() {
                $(this).closest('tr').remove();
            });


            $('#submit_data').click(function() {
                if(confirm("ເລີ່ມແທ້ງ?"))
                { 
                    if(cacu_total()>{{ $money }})
                    {
                        alert('ຍອດເຄຣດີທບໍ່ພໍ ກະລຸນາເຕີມເຄຣດີທ');
                    }
                    else
                    {
                        
                    } 
                    $('#submit_data').prop('disabled','disabled');
                    let custom_data = '123';
                    let pick_type = $('#pick_type').val();
                    let numberInputsContainer = $('#numberInputsContainer');
                    
                    // Collect number and price data
                    let data = [];
                    let valid = true; // Flag to check validation

                    numberInputsContainer.find('tr').each(function() {
                        let number = $(this).find('.number').val();
                        let price = $(this).find('.price').val();

                        if (number !== '' && price !== '') {
                            data.push({
                                number: number,
                                price: price
                            });
                        } else {
                            if (number === '') {
                                $(this).find('.number').focus();
                                alert('Number must not be empty');
                            } else if (price === '') {
                                $(this).find('.price').focus();
                                alert('Price must not be empty');
                            }
                            valid = false; // Set valid to false if any field is empty
                            
                            $('#submit_data').prop('disabled','');
                            return false; // Break the loop
                        }
                    });

                    // Proceed with AJAX only if all fields are valid
                    if (valid) {
                        $.ajax({
                            url: '{{ route('buy.run.start',$gain_number) }}', // Replace with your Laravel route
                            type: 'POST',
                            data: {
                                custom_data: custom_data,
                                pick_type: pick_type,
                                data: data,
                                _token: $('meta[name="csrf-token"]').attr('content') // Ensure the CSRF token is correctly included
                            },
                            success: function(response) {
                                if(response.status=='CLOSED')
                                {
                                    alert('ຂໍອະໄພປິດການຂາຍແລ້ວ');
                                }
                                else
                                {
                                    window.location.href = '{{ url('/2749/248/0302/4421/7799/778') }}/'+ response.order; 
                                }
                                
                            },
                            error: function(error) {
                                console.error(error);
                                $('#submit_data').prop('disabled','');
                                alert('ເພີ່ມໝາຍເລກ.');
                            }
                        });
                    }
                
                }
                else
                {

                } 
            });

        });

        function Comma(Num) {  
            Num += '';
            Num = Num.replace(',', ''); Num = Num.replace(',', ''); Num = Num.replace(',', '');
            Num = Num.replace(',', ''); Num = Num.replace(',', ''); Num = Num.replace(',', '');
            x = Num.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1))
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            return x1 + x2;
        }

        function number_format (number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        function cacu_total()
        {
            let total = 0;
            
            let numberInputsContainer = $('#numberInputsContainer');
                numberInputsContainer.find('tr').each(function() {
                    let number = $(this).find('.number').val();
                    let price = $(this).find('.price').val();

                    if (number !== '' && price !== '') {
                        total = +(total) + +(price.replace(/,/g, ''));
                        console.log(total);
                        console.log(price);
                    } else {
                     
                    }
                });
                $('#display_total').html('ລວມ  : ' + number_format(total,'','',',') + ' ກີບ');
            
            return total;
        }
    </script>
@endsection