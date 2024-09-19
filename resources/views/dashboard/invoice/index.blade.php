@extends('dashboard.layouts.app')
@section('style')

<link rel="stylesheet" href="https://cdn.invoice-generator.com/theme_light.9ae229e2.css" id="theme-link">
<link rel="stylesheet" href="https://cdn.invoice-generator.com/197.655399c9.css"><link rel="stylesheet" href="https://cdn.invoice-generator.com/app.bc26e048.css">
<link rel="stylesheet" href="{{asset('dashboard_assets/vendor/select2/css/select2.min.css')}}">
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


<div class="row m-auto">
    <div class="col-lg-9 m-auto " >
        <div id="" class="invoice-holder clearfix " style="margin-bottom: 5rem;">
            <form method="post" action="{{ route('invoice.store') }}" class="form-horizontal" enctype="multipart/form-data">
                @csrf


                <div class="invoice-controls desktop">
                    <div class="affix-el" id="invoice-controls-affix">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <span class="fas fa-arrow-to-bottom"></span> Save Invoice
                            </button>
                        </div>

                        <div class="border-top  px-3 mt-5">
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
                        <div class="border-top px-3 mt-5">
                            <div class="mt-3">
                                <label class="control-label">Client</label>
                                <div>
                                    <select class="single-select client-select" name="client_id">
                                        <option value="none"  selected  >None</option>
                                            @forelse ($clients as $data  )
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @empty
                                            <option disabled> No Data</option>
                                            @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="border-top border-bottom px-3 mt-5 project d-none">
                            <div class="mt-3">
                                <label class="control-label">Project</label>
                                <div>
                                    <select id="project-select" class="single-select" name="project_id">

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
                                                <input type="text" class="input-label form-control form-control-sm" name="bill_to_label" value="Bill To" readonly  />
                                            </div>
                                            <div class="value">
                                                <input id="to" class="form-control" type="text" placeholder="who is this to?" name="bill_to_value" required value="{{ old('bill_to_value') }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="invoice-details pt-3" style="margin-top: 37px;">
                                    <!-- Date -->
                                    <div class="input-group addon-input">
                                        <input class="input-label form-control form-control-sm" type="text" name="date_label" value="Date" required value="{{ old('data_label') }}" />
                                        <div class="input-group-addon">
                                            <input id="invoiceDate" class="form-control form-control-sm datepicker" type="date" name="date_value" value="{{ old('date_value') }}"  required />
                                        </div>
                                    </div>

                                    <!-- Payment Terms -->
                                    <div class="input-group addon-input" ng-hide="document.type == 'credit_note'">
                                        <input class="input-label form-control form-control-sm" type="text" name="payment_terms_label" value="Payment Terms" required  />
                                        <div class="input-group-addon">
                                            <input id="invoiceDueDate" class="form-control form-control-sm datepicker" type="text" name="payment_terms_value" value="{{ old('payment_terms_value') }}" required />
                                        </div>
                                    </div>

                                    <!-- Due Date -->
                                    <div class="input-group addon-input">
                                        <input class="input-label form-control form-control-sm" type="text" name="due_data_label" value="Due Date" required />
                                        <div class="input-group-addon">
                                            <input id="invoiceDueDate" class="form-control form-control-sm datepicker" type="date" name="due_date_value" value="{{ old('due_date_value') }}" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="items-holder">
                            <div id="item-holder" class="items-table-header rounded-1   mb-1" style="background: #3b82f6;">
                                <div class="amount">
                                    <div class="theme-label bordered">
                                        <input type="text" class="input-label input-label-custom form-control form-control-sm text-light " value="Amount" name="itemAmountLabel" />
                                    </div>
                                </div>
                                <div class="unit_cost">
                                    <div class="theme-label bordered">
                                        <input type="text" class="input-label  input-label-custom form-control form-control-sm text-light" value="Rate" name="itemRatelabel" />
                                    </div>
                                </div>
                                <div class="quantity">
                                    <div class="theme-label bordered">
                                        <input type="text" class="input-label  input-label-custom form-control form-control-sm text-light" value="Quantity" name="itemQtyLabel" />
                                    </div>
                                </div>
                                <div class="name">
                                    <div class="theme-label bordered">
                                        <input type="text" class="input-label  input-label-custom form-control form-control-sm text-light" value="Description" name="itemDescLabel" />
                                    </div>
                                </div>
                            </div>
                            <div id="items" class="items-table">
                                <div class="item-row pb-1">
                                    <div class="main-row">
                                        <div class="delete"></div>
                                        <input type="hidden" name="itemAmount[]" class="amount_value">
                                        <div  class="amount value amount_div">
                                            <span class="currency-symbol">$</span>
                                            0
                                        </div>
                                        <div class="unit_cost">
                                            <div class="input-group input-group-sm">
                                                <span  class="input-group-text pe-2 ps-2 currency-sign currency-symbol">$</span>
                                                <input  class="item-calc form-control form-control-sm border-start-0 ps-2 rate_input" type="number" step="any" autocomplete="off" name="itemRate[]" value="0" />
                                            </div>
                                        </div>
                                        <div class="quantity">
                                            <input  type="number" step="any" class="item-calc form-control form-control-sm quantity_input" autocomplete="off" name="itemQty[]" value="0" />
                                        </div>
                                        <div class="name">
                                            <input class="item-calc form-control form-control-sm" rows="1" name="itemDesc[]" placeholder="Description of item/service...">
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
                                            <input type="text" class="input-label form-control form-control-sm" name="note_label" value="Notes" required    />
                                        </div>
                                        <div class="value">
                                            <textarea class="notes form-control form-control-sm" placeholder="Notes - any relevant information not already covered" name="note_value" >{{ old('note_value') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="terms-holder mt-3">
                                        <div class="theme-label mb-1">
                                            <input type="text" class="input-label form-control form-control-sm" name="term_label" value="Terms"  required/>
                                        </div>
                                        <div class="value">
                                            <textarea class="terms form-control form-control-sm" placeholder="Terms and conditions - late fees, payment methods, delivery schedule" name="term_value">{{ old('term_value') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group addon-input">
                                    <input class="input-label form-control form-control-sm " type="text" name="subtotal_label" required value="Subtotal" />
                                    <input type="hidden" name="subtotal_value" class="subtotal_value">
                                    <div id="subtotal_div" class="input-group-addon value pr-5"><span class="currency-symbol">$</span>0</div>
                                </div>



                                <div class="input-group addon-input">
                                    <input class="input-label form-control form-control-sm" type="text" name="discount_label" value="Discount" required />
                                    <div class="input-group-addon">
                                        <div class="input-group input-group-sm">
                                            <input id="discount_input" class="item-calc form-control  custom-input form-control-sm  ps-2" type="number" name="discount_value"   value="0" style="border-right: none;" />
                                            <input type="hidden" name="discount_type" id="discount_type">
                                            <div id="discount" class="percent-custom   " style="margin-right: 1px;">%</div>
                                            <button id="exchange" type="button" class="btn btn-square btn-light " >
                                                <span  class="fa fa-exchange"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group addon-input">
                                    <input class="input-label form-control form-control-sm" type="text" name="tax_label" required value="Tax" />

                                    <div class="input-group-addon">
                                        <div class="input-group input-group-sm">
                                            <input id="tax_input" class="item-calc form-control form-control-sm ps-2" type="number" name="tax_value" value="0" />
                                            <span class="input-group-text pe-2 ps-2 currency-sign curre">%</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="input-group addon-input">
                                    <input class="input-label form-control form-control-sm" type="text" name="total_label" value="Total" />
                                    <input type="hidden" name="total_value" class="total_value">
                                    <div id="total_div" class="input-group-addon value pr-5 "><span class="currency-symbol">$</span>0</div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>

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
<script src="{{asset('dashboard_assets/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/plugins-init/select2-init.js')}}"></script>
<script>


  // Listen for changes on the client dropdown
  $('select[name="client_id"]').change(function() {
        // Get the list of all projects
        let projects = @json($projects);
        // Get the currently selected client ID
        let selectedClientId = $(this).val();
        let name = $(this).find(':selected').text();
        if(name == 'None'){
            $('#to') .val('');
        }else{
            $('#to') .val(name);
        }

        // Clear the existing options in the project dropdown
        $('#project-select').empty();

        // Always add a 'None' option
        $('#project-select').append($('<option>', {
            value: 'none',
            text: 'None'
        }));

        // Handle the case where 'None' is selected for the client
        if (selectedClientId == 'none') {
            $('.project').addClass('d-none');
        } else {
            $('.project').removeClass('d-none');
            // Filter and append projects that belong to the selected client
            projects.filter(project => project.client_id == selectedClientId)
                    .forEach(project => {
                        $('#project-select').append($('<option>', {
                            value: project.id,
                            text: project.name
                        }));
                    });
        }
    });

$(document).ready(function() {
    var currentCurrencySymbol = '$'; // Initialize with the default currency symbol

    // Function to calculate and update the amount for each item line
    function updateAmount(itemRow) {
        var rate = $(itemRow).find('.rate_input').val();
        var quantity = $(itemRow).find('.quantity_input').val();
        var amount = (rate * quantity) || 0; // Calculate the amount or default to 0 if NaN
        var symbol = ` <span class="currency-symbol">${currentCurrencySymbol}</span>`
        $(itemRow).find('.amount_div').html(symbol + amount.toFixed(2)); // Update the amount in the corresponding div
        $(itemRow).find('.amount_value').val(amount); // Update the amount in the corresponding div
        console.log(amount);
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
        $('.subtotal_value').val(subtotal.toFixed(2)); // Update the subtotal value in the form
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
            $('#discount_type').val(currentCurrencySymbol);
            y = !y;
            discountCalculate();
        } else {
            discountDiv.text('%');
            $('#discount_type').val(currentCurrencySymbol);
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
                     <input type="hidden" name="itemAmount[]" class="amount_value">
                     <div class="amount value amount_div">
                         <span class="currency-symbol">${currentCurrencySymbol}</span>
                         0
                     </div>
                     <div class="unit_cost">
                         <div class="input-group input-group-sm">
                             <span class="input-group-text pe-2 ps-2 currency-sign currency-symbol">${currentCurrencySymbol}</span>
                             <input class="item-calc form-control form-control-sm border-start-0 ps-2 rate_input" type="number" step="any" autocomplete="off" name="itemRate[]" value="0" />
                         </div>
                     </div>
                     <div class="quantity">
                         <input type="number" step="any" class="item-calc form-control form-control-sm quantity_input" autocomplete="off" name="itemQty[]" value="0" />
                     </div>
                     <div class="name">
                         <input class="item-calc form-control form-control-sm" rows="1" name="itemDesc[]" placeholder="Description of item/service...">
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
        $('.total_value').val($value.toFixed(2));
    }

});


</script>
    <!-- Datatable -->

@endsection
