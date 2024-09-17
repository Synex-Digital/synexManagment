@extends('dashboard.layouts.app')
@section('style')

<link rel="stylesheet" href="https://cdn.invoice-generator.com/theme_light.9ae229e2.css" id="theme-link">
<link rel="stylesheet" href="https://cdn.invoice-generator.com/197.655399c9.css"><link rel="stylesheet" href="https://cdn.invoice-generator.com/app.bc26e048.css">
<style>
    .header-right{
        right: 0;
        position: absolute;
    }
    .input-label-custom{
        background: #3b82f6 !important;
    }
    .input-group-text{
        background: #3b82f6 !important;
    }
.line-item:hover{
    background: #3b82f6 !important;
    color: #fff !important;
}
.input-group-addon {
    padding-right: 0px !important;
}
.percent-custom{
    border-top: 1px solid #eaeaea;
    border-right: 1px solid #eaeaea;
    border-bottom: 1px solid #eaeaea;
    padding: 8px 7px 7px 7px;
    height: 37px;

}
.percent-custom{
    transition: .1s;
}
.custom-input:focus + .percent-custom{
    transition:  .1s;
    border: #aa96ff 1px solid !important;
}
</style>

@endsection
@section('content')

<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Invoice</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-primary">Invoice</a></li>
            {{-- <li class="breadcrumb-item " ><a class="text-primary">Project List</a></li> --}}
        </ol>
    </div>

</div>

<div id="adngin-top-0"></div>
<div class="container">
    <div id="static" class="invoice-holder clearfix">
        <form method="post" action="/pdf" class="form-horizontal" enctype="multipart/form-data">
            <div class="mobile-btns bg-white border-top">
                <div class="inner">
                    <div class="right">
                        <button type="submit" class="btn btn-primary btn-block">
                            Download Invoice
                        </button>
                    </div>
                </div>
            </div>

            <div class="invoice-controls desktop">
                <div class="affix-el" id="invoice-controls-affix">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <span class="fas fa-arrow-to-bottom"></span> Save Invoice
                        </button>
                    </div>

                    <div class="border-top border-bottom px-3 mt-5">
                        <div class="mt-3">
                            <label class="control-label">Currency</label>
                            <div>
                                <select class="form-select" name="currency">
                                        <option value="USD" >USD ($)</option>
                                        <option value="BDT" >BDT (৳) </option>
                                </select>
                            </div>
                        </div>


                    </div>

                    <div id="adngin-side_1-0"></div>
                </div>
            </div>

            <div class="papers">
                <div class="invoice-editor">
                    <div class="row">

                        <div class="col-lg-12 ">
                            <img class="float-left mt-4" width="160" height="60" src="{{ asset('uploads/synex-logo.jpg') }}" alt="">
                            <div class="offset-md-8">
                                <div class="title">
                                    <input type="text" class="form-control form-control-sm input-label" name="header" value="INVOICE" />

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">


                            <div class="row " style="margin-top: 63px;">

                                <div class="col-md-6">
                                    <div class="contact pt-3">
                                        <div class="theme-label mb-1">
                                            <input type="text" class="input-label form-control form-control-sm" name="to_title" value="Bill To" />
                                        </div>
                                        <div class="value">
                                            <textarea class="form-control form-control-sm" placeholder="Who is this to?" name="to"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="invoice-details pt-3" style="margin-top: 37px;">
                                <!-- Date -->
                                <div class="input-group addon-input">
                                    <input class="input-label form-control form-control-sm" type="text" name="date_title" value="Date" />
                                    <div class="input-group-addon">
                                        <input id="invoiceDate" class="form-control form-control-sm datepicker" type="date" name="date" value="Sep 12, 2024" />
                                    </div>
                                </div>

                                <!-- Payment Terms -->
                                <div class="input-group addon-input" ng-hide="document.type == 'credit_note'">
                                    <input class="input-label form-control form-control-sm" type="text" name="payment_terms_title" value="Payment Terms" />
                                    <div class="input-group-addon">
                                        <input id="invoiceDueDate" class="form-control form-control-sm datepicker" type="text" name="payment_terms" />
                                    </div>
                                </div>

                                <!-- Due Date -->
                                <div class="input-group addon-input">
                                    <input class="input-label form-control form-control-sm" type="text" name="due_date_title" value="Due Date" />
                                    <div class="input-group-addon">
                                        <input id="invoiceDueDate" class="form-control form-control-sm datepicker" type="date" name="due_date" />
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="items-holder">
                        <div id="item-holder" class="items-table-header rounded-1   mb-1" style="background: #3b82f6;">
                            <div class="amount">
                                <div class="theme-label bordered">
                                    <input type="text" class="input-label input-label-custom form-control form-control-sm text-light " value="Amount" name="amount_header" />
                                </div>
                            </div>
                            <div class="unit_cost">
                                <div class="theme-label bordered">
                                    <input type="text" class="input-label  input-label-custom form-control form-control-sm text-light" value="Rate" name="unit_cost_header" />
                                </div>
                            </div>
                            <div class="quantity">
                                <div class="theme-label bordered">
                                    <input type="text" class="input-label  input-label-custom form-control form-control-sm text-light" value="Quantity" name="quantity_header" />
                                </div>
                            </div>
                            <div class="name">
                                <div class="theme-label bordered">
                                    <input type="text" class="input-label  input-label-custom form-control form-control-sm text-light" value="Description" name="item_header" />
                                </div>
                            </div>
                        </div>
                        <div id="items" class="items-table">
                            <div class="item-row pb-1">
                                <div class="main-row">
                                    <div class="delete"></div>
                                    <div  class="amount value amount_div">
                                        <span class="currency-symbol">$</span>
                                        0

                                    </div>
                                    <div class="unit_cost">
                                        <div class="input-group input-group-sm">
                                            <span  class="input-group-text pe-2 ps-2 currency-sign currency-symbol">$</span>
                                            <input  class="item-calc form-control form-control-sm border-start-0 ps-2 rate_input" type="number" step="any" autocomplete="off" name="items[0][unit_cost]" value="0" />
                                        </div>
                                    </div>
                                    <div class="quantity">
                                        <input  type="number" step="any" class="item-calc form-control form-control-sm quantity_input" autocomplete="off" name="items[0][quantity]" value="0" />
                                    </div>
                                    <div class="name">
                                        <textarea class="item-calc form-control form-control-sm" rows="1" name="items[0][name]" placeholder="Description of item/service..."></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="new-line">
                            <button type="button" class="btn line-item btn-sm " id="addLineItemBtn" tabindex="1000"  style="border: .5px solid #3b82f6; color :#3b82f6">
                                <span class="fa fa-plus"></span>
                                Line Item
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="invoice-footer">
                                <div class="notes-holder">
                                    <div class="theme-label mb-1">
                                        <input type="text" class="input-label form-control form-control-sm" name="notes_title" value="Notes" />
                                    </div>
                                    <div class="value">
                                        <textarea class="notes form-control form-control-sm" placeholder="Notes - any relevant information not already covered" name="notes"></textarea>
                                    </div>
                                </div>
                                <div class="terms-holder mt-3">
                                    <div class="theme-label mb-1">
                                        <input type="text" class="input-label form-control form-control-sm" name="terms_title" value="Terms" />
                                    </div>
                                    <div class="value">
                                        <textarea class="terms form-control form-control-sm" placeholder="Terms and conditions - late fees, payment methods, delivery schedule" name="terms"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group addon-input">
                                <input class="input-label form-control form-control-sm " type="text" name="subtotal_title" value="Subtotal" />
                                <div id="subtotal_div" class="input-group-addon value pr-5"><span class="currency-symbol">$</span>0</div>
                            </div>



                            <div class="input-group addon-input">
                                <input class="input-label form-control form-control-sm" type="text" name="tax_title" value="Discount" />
                                <div class="input-group-addon">
                                    <div class="input-group input-group-sm">
                                        <input id="discount_input" class="item-calc form-control  custom-input form-control-sm  ps-2" type="number"   value="0" style="border-right: none;" />
                                        <div id="discount" class="percent-custom   " style="margin-right: 1px;">%</div>
                                        <button id="exchange" type="button" class="btn btn-square btn-light " >
                                            <span  class="fa fa-exchange"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group addon-input">
                                <input class="input-label form-control form-control-sm" type="text" name="tax_title" value="Tax" />
                                <div class="input-group-addon">
                                    <div class="input-group input-group-sm">
                                        <input id="tax_input" class="item-calc form-control form-control-sm ps-2" type="number" value="0" />
                                        <span class="input-group-text pe-2 ps-2 currency-sign curre">%</span>
                                    </div>
                                </div>
                            </div>


                            <div class="input-group addon-input">
                                <input class="input-label form-control form-control-sm" type="text" name="total_title" value="Total" />
                                <div id="total_div" class="input-group-addon value pr-5 "><span class="currency-symbol">$</span>0</div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>

</div>





     <!-- Modal -->
 <div class="modal fade" id="createModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Expenses</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('expenses.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="" class="form-label font-weight-bold">Expenses Type <span class="text-danger">*</span>  </label>
                            <input type="text" name="type" class="form-control" placeholder="Salary, Software Purchase, Tools, Others" required value="{{old('type')}}">
                        </div>
                        {{-- <div class="form-group col-md-6">
                          <label for="inputPassword4" class="font-weight-bold">Email :</label>
                          <input type="password" class="form-control" id="inputPassword4" placeholder="Enter Email">
                        </div> --}}
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label font-weight-bold">Employee</label>
                        <select name="employee_id" class="single-select">
                            <option value="">NONE</option>

                        </select>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4" class="font-weight-bold">Purchase Date</label>
                            <input type="date" name="date" class="form-control" id="inputPassword4" value="{{old('date')}}" >
                          </div>
                        <div class="form-group col-md-6">
                            <label for="" class="form-label font-weight-bold">Purchased By <span class="text-danger">*</span></label>
                            <input type="text" name="purchased_by" class="form-control" placeholder="Name" required value="{{old('purchased_by')}}">
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label font-weight-bold">Ammount <span class="text-danger">*</span></label>
                        <input type="number" name="amount" class="form-control " min="0" placeholder="৳" required value="{{old('amount')}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label font-weight-bold">Note</label>
                       <textarea  name="note" id="" class="form-control "  placeholder="Description" cols="30" rows="5"> {{old('note')}} </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Add Expenses</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
// $(document).ready(function() {
//     var currentCurrencySymbol = '$'; // Initialize with the default currency symbol

//     // Function to update currency symbols based on selection
//     function updateCurrencySymbols(currency) {
//         currentCurrencySymbol = currency === "USD" ? '$' : '৳';
//         $('.currency-symbol').each(function() {
//             $(this).text(currentCurrencySymbol);
//         });
//     }

//     // Handle currency change
//     $('select[name="currency"]').change(function() {
//         var selectedCurrency = $(this).val();
//         updateCurrencySymbols(selectedCurrency);
//     });

//     // Initialize with the default value
//     updateCurrencySymbols($('select[name="currency"]').val());

//     // Add new line item with the current currency symbol
//     $('#addLineItemBtn').click(function() {
//         const newItemHtml = `
//           <div class="item-row pb-1">
//                  <div class="main-row">
//                      <div class="delete">
//                          <button class="btn btn-outline-danger btn-sm delete-btn"> <i class="fa fa-times"></i></button>
//                      </div>
//                      <div class="amount value amount_div">
//                          <span class="currency-symbol">${currentCurrencySymbol}</span>
//                          0
//                      </div>
//                      <div class="unit_cost">
//                          <div class="input-group input-group-sm">
//                              <span class="input-group-text pe-2 ps-2 currency-sign currency-symbol">${currentCurrencySymbol}</span>
//                              <input class="item-calc form-control form-control-sm border-start-0 ps-2 rate_input" type="number" step="any" autocomplete="off" name="unit_cost" value="0" />
//                          </div>
//                      </div>
//                      <div class="quantity">
//                          <input type="number" step="any" class="item-calc form-control form-control-sm quantity_input" autocomplete="off" name="quantity" value="0" />
//                      </div>
//                      <div class="name">
//                          <textarea class="item-calc form-control form-control-sm" rows="1" name="name" placeholder="Description of item/service..."></textarea>
//                      </div>
//                  </div>
//              </div>`;
//         $('#items').append(newItemHtml);
//     });

//     // Delegate the click event for dynamic elements
//     $('#items').on('click', '.delete-btn', function() {
//         $(this).closest('.item-row').remove();
//     });
// });




// $(document).ready(function() {
//     // Function to calculate the amount
//     function calculateAmount() {
//         var rate = $('.rate_input').val(); // Get the value of the rate input
//         var quantity = $('.quantity_input').val(); // Get the value of the quantity input
//         var amount = rate * quantity; // Calculate the amount

//         // Update the amount_div with the new amount
//         $('.amount_div').text('$' + amount.toFixed(2)); // Format to 2 decimal places
//         $('#subtotal_div').text('$' + amount.toFixed(2)); // Format to 2 decimal places
//     }

//     // Attach event listeners to the rate and quantity input fields
//     $('.rate_input, .quantity_input').on('input', function() {
//         calculateAmount(); // Call calculateAmount whenever any input changes
//     });
// });



$(document).ready(function() {
    var currentCurrencySymbol = '$'; // Initialize with the default currency symbol

    // Function to calculate and update the amount for each item line
    function updateAmount(itemRow) {
        var rate = $(itemRow).find('.rate_input').val();
        var quantity = $(itemRow).find('.quantity_input').val();
        var amount = (rate * quantity) || 0; // Calculate the amount or default to 0 if NaN
        var symbol = ` <span class="currency-symbol">${currentCurrencySymbol}</span>`
        $(itemRow).find('.amount_div').html(symbol + amount.toFixed(2)); // Update the amount in the corresponding div
        updateSubtotal(); // Update the subtotal whenever any amount changes
    }
    let afterDvalue = 0;
    let x = 0;
    // Function to calculate and update the subtotal for all items
    function updateSubtotal() {
        var subtotal = 0;
        $('.amount_div').each(function() {
            var amountText = $(this).text(); // Get the amount text
            var amount = parseFloat(amountText.replace(currentCurrencySymbol, '')); // Remove the currency symbol and convert to float
            subtotal += amount; // Sum up all the amounts
        });
        $('#subtotal_div').text(currentCurrencySymbol + subtotal.toFixed(2)); // Update the subtotal div
        x = subtotal;
        discountCalculate();
    }

    // Listen to input changes for rate and quantity in any item row
    $('#items').on('input', '.rate_input, .quantity_input', function() {
        var itemRow = $(this).closest('.main-row'); // Find the parent row of the changed input
        updateAmount(itemRow); // Update the amount for this specific item row
        taxCalculate();
    });

    // Function to update currency symbols based on selection
    function updateCurrencySymbols(currency) {
        currentCurrencySymbol = currency === "USD" ? '$' : '৳';

        $('.currency-symbol').each(function() {
            $(this).text(currentCurrencySymbol);
        });
        updateSubtotal(); // Update the subtotal to reflect the new currency symbol
    }
    let y = false;
    $('#exchange').click(function() {
        var discountDiv = $('#discount');
        if (discountDiv.text() === '%') {
            discountDiv.text(currentCurrencySymbol);
            y = !y;
            discountCalculate();
        } else {
            discountDiv.text('%');
            y = !y;
            discountCalculate();
        }

    });
    // Handle currency change
    $('select[name="currency"]').change(function() {
        var selectedCurrency = $(this).val();
        updateCurrencySymbols(selectedCurrency);
    });

    // Initialize with the default value
    updateCurrencySymbols($('select[name="currency"]').val());

    // Add new line item with the current currency symbol
    $('#addLineItemBtn').click(function() {
        const newItemHtml = `
          <div class="item-row pb-1">
                 <div class="main-row">
                     <div class="delete">
                         <button class="btn btn-outline-danger btn-sm delete-btn"> <i class="fa fa-times"></i></button>
                     </div>
                     <div class="amount value amount_div">
                         <span class="currency-symbol">${currentCurrencySymbol}</span>
                         0
                     </div>
                     <div class="unit_cost">
                         <div class="input-group input-group-sm">
                             <span class="input-group-text pe-2 ps-2 currency-sign currency-symbol">${currentCurrencySymbol}</span>
                             <input class="item-calc form-control form-control-sm border-start-0 ps-2 rate_input" type="number" step="any" autocomplete="off" name="unit_cost" value="0" />
                         </div>
                     </div>
                     <div class="quantity">
                         <input type="number" step="any" class="item-calc form-control form-control-sm quantity_input" autocomplete="off" name="quantity" value="0" />
                     </div>
                     <div class="name">
                         <textarea class="item-calc form-control form-control-sm" rows="1" name="name" placeholder="Description of item/service..."></textarea>
                     </div>
                 </div>
             </div>`;
        $('#items').append(newItemHtml);
        updateSubtotal(); // Recalculate subtotal when a new item is added
    });

    // Delegate the click event for dynamic elements
    $('#items').on('click', '.delete-btn', function() {
        $(this).closest('.item-row').remove();
        updateSubtotal(); // Recalculate subtotal when an item is removed
        discountCalculate();
        taxCalculate();
    });

    $('#discount_input').on('input', function() {
        discountCalculate();
    });
    $('#tax_input').on('input', function() {
        taxCalculate();

    });

    function discountCalculate(){
        let val = $('#discount_input').val();
        let discount = 0;
        if( y == true) {
             discount = (x - val);
             total(discount);
             afterDvalue = discount;
        }else{
            discount = (x - (x * val) / 100);
            total(discount);
            afterDvalue = discount;
        }
    }
    function taxCalculate(){

        let val = $('#tax_input').val();
        let tax = 0;
        tax = afterDvalue + (afterDvalue * val) / 100;
        total(tax);
    }
    function total($value){
        $('#total_div').text(currentCurrencySymbol + $value.toFixed(2));
    }

});


</script>
    <!-- Datatable -->

@endsection
