@extends('layout.app')  

<link rel="stylesheet" href="{{ asset('css/front-menu-list.css') }}">
@section('content')  
<div class="container">
     <div class="row"> 
        
        <div class="col-12 mt-2">
            <div class="card notob">
                <div class="card-header text-center"> 
                    <h3>ເລກວິ້ງ</h3>
                </div>
                <div class="card-body p-1 d-flex"> 
                    <table class="table table-bordered   ">
                        <thead> 
                        </thead>
                        <tbody>
                            <tr> 
                                <td class="text-center">
                                    <input type="text" class="form-control simple-input" id="inputValues" placeholder="ປ້ອນເລກ" value="1,2,3,4,5,6,7,8,9"  >
                                </td>
                                <td class="text-right"> 
                                    <input type="text" class="form-control simple-input" placeholder="ຈຳນວນເງິນ"  >
                                </td> 
                                <td>
                                    <button class="btn" id="goButton">Go</button>
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
            <div class="card notob">
                <table class="table table-bordered table-hover  ">
                    <thead>
                        <tr> 
                            <th class="text-center" style="background:#d82108;" width="8%"></th>
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
                <select name="pick_type" id="pick_type">
                    <option value="UP">Up</option>
                    <option value="DOWN">Down</option>
                </select>
                <button id="submit_data">Go</button>
            </div>
        </div>
     </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#inputValues').focus();

            $('#goButton').click(function() {
                var inputValues = $('#inputValues').val();
                var numberInputsContainer = $('#numberInputsContainer'); 
                var validNumber = 1; 
        
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
                                    <input type="text" class="form-control simple-input price" >
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
            });

            // Add event listener for delete buttons
            $(document).on('click', '.btn-delete', function() {
                $(this).closest('tr').remove();
            });

            $('#submit_data').click(function() {
                let custom_data = '123';
                let pick_type = $('#pick_type').val();

                let numberInputsContainer = $('#numberInputsContainer');

                // Collect number and price data
                let data = [];
                numberInputsContainer.find('tr').each(function() {
                    let number = $(this).find('.number').val();
                    let price = $(this).find('.price').val();
                    data.push({
                        number: number,
                        price: price
                    });
                });

                // Send it through AJAX to Laravel controller
                $.ajax({
                    url: '{{ route('buy.run.start') }}',  // Replace with your Laravel route
                    type: 'POST',
                    data: {
                        custom_data: custom_data,
                        pick_type: pick_type,
                        data: data,
                        _token: '{{ csrf_token() }}'  // Include CSRF token for Laravel
                    },
                    success: function(response) {
                        console.log(response);
                        alert('Data submitted successfully!');
                    },
                    error: function(error) {
                        console.error(error);
                        alert('An error occurred while submitting data.');
                    }
                });
            });

        });



    </script>
@endsection