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
    transition: .1s !important;
}
.custom-input:focus ~ .percent-custom{
    transition:  .1s !important;
    border: #aa96ff 1px solid !important;
}

</style>

@endsection
@section('content')

<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="">Invoice</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('invoice.list') }}" class="">Invoice</a></li>
            <li class="breadcrumb-item " ><a class="text-primary">Update</a></li>
        </ol>
    </div>

</div>
<div class="row">

    <div class="col-lg-12">
        <a href="{{ route('invoice.generate') }}" class="btn btn-rounded btn-primary mr-3 text-white" >
            <span class="btn-icon-left text-primary mr-2" style="    margin: -4px 0px -4px -10px;"  >  <i class="fa fa-plus color-info"style="    margin: 2px -3px 1px -3px;" ></i> </span>Generate</a>
        <a href="{{ route('invoice.list') }}" class="btn btn-rounded btn-primary mr-3 text-white" >
            <span class="btn-icon-left text-primary mr-2" style="    margin: -4px 0px -4px -10px;"  >  <i class="fa fa-list color-info"style="    margin: 2px -3px 1px -3px;" ></i> </span>Invoice List</a>

        </div>
    </div>
<div class="row m-auto">

    <div class="col-lg-9 m-auto " >
        <div id="" class="invoice-holder clearfix " style="margin-bottom: 5rem;">
            <form method="post" action="{{ route('invoice.update') }}" class="form-horizontal" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                <div class="invoice-controls desktop">
                    <div class="affix-el" id="invoice-controls-affix">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <span class="fas fa-arrow-to-bottom"></span> Update Invoice
                            </button>
                        </div>

                        <div class="border-top  px-3 mt-5">
                            <div class="mt-3">
                                <label class="control-label">Currency</label>
                                <div>
                                    <select class="form-select" name="currency">
                                        <option {{ $invoice->currency == 'USD' ? 'selected' : '' }} value="USD" >USD ($)</option>
                                        <option {{ $invoice->currency == 'BDT' ? 'selected' : '' }} value="BDT" >BDT (৳) </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="border-top px-3 mt-5">
                            <div class="mt-3">
                                <label class="control-label">Client</label>
                                <div>
                                    <select class="single-select client-select" name="client_id">
                                        <option value="none" {{ empty($invoice->client_id) ? 'selected' : '' }}>None</option>
                                        @forelse ($clients as $data)
                                            <option {{ $invoice->client_id == $data->id ? 'selected' : '' }} value="{{ $data->id }}">{{ $data->name }}</option>
                                        @empty
                                            <option disabled>No Data</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="border-top border-bottom px-3 mt-5 project">
                            <div class="mt-3">
                                <label class="control-label">Project</label>
                                <div>
                                    <select id="project-select" class="single-select" name="project_id">
                                        <option value="none" {{ empty($invoice->project_id) ? 'selected' : '' }}>None</option>
                                        @foreach ($projects as $project)
                                            @if ($project->client_id == $invoice->client_id)
                                                <option value="{{ $project->id }}" {{ $invoice->project_id == $project->id ? 'selected' : '' }}>
                                                    {{ $project->name }}
                                                </option>
                                            @endif
                                        @endforeach
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
                                        <input type="text" class="form-control form-control-sm input-label" name="header" value="{{ $invoice->header }}" />

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
                                                <input type="text" class="input-label form-control form-control-sm" name="bill_to_label" value="{{ $invoice->labels->first()->bill_to_label }}" required  />
                                            </div>
                                            <div class="value">
                                                <input id="to" class="form-control" type="text" placeholder="who is this to?" name="bill_to_value" required value="{{ $invoice->bill_to_value }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="invoice-details pt-3" style="margin-top: 37px;">
                                    <!-- Date -->
                                    <div class="input-group addon-input">
                                        <input class="input-label form-control form-control-sm" type="text" name="date_label"  required value="{{ $invoice->labels->first()->date_label  }}" />
                                        <div class="input-group-addon">
                                            <input id="invoiceDate" class="form-control form-control-sm datepicker" type="date" name="date_value" value="{{ $invoice->date_value }}"  required />
                                        </div>
                                    </div>

                                    <!-- Payment Terms -->
                                    <div class="input-group addon-input" ng-hide="document.type == 'credit_note'">
                                        <input class="input-label form-control form-control-sm" type="text" name="payment_terms_label" value="{{ $invoice->labels->first()->payment_terms_label }}" required  />
                                        <div class="input-group-addon">
                                            <input id="invoiceDueDate" class="form-control form-control-sm datepicker" type="text" name="payment_terms_value" value="{{ $invoice->payment_terms_value }}" required />
                                        </div>
                                    </div>

                                    <!-- Due Date -->
                                    <div class="input-group addon-input">
                                        <input class="input-label form-control form-control-sm" type="text" name="due_date_label" value="{{ $invoice->labels->first()->due_date_label }}" required />
                                        <div class="input-group-addon">
                                            <input id="invoiceDueDate" class="form-control form-control-sm datepicker" type="date" name="due_date_value" value="{{ $invoice->due_date_value }}" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="items-holder">
                            <div id="item-holder" class="items-table-header rounded-1   mb-1" style="background: #3b82f6;">
                                <div class="amount">
                                    <div class="theme-label bordered">
                                        <input type="text" class="input-label input-label-custom form-control form-control-sm text-light " value="{{ $invoice->labels->first()->item_amount_label }}" name="itemAmountLabel" />
                                    </div>
                                </div>
                                <div class="unit_cost">
                                    <div class="theme-label bordered">
                                        <input type="text" class="input-label  input-label-custom form-control form-control-sm text-light" value="{{ $invoice->labels->first()->item_rate_label }}" name="itemRatelabel"  required/>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <div class="theme-label bordered">
                                        <input type="text" class="input-label  input-label-custom form-control form-control-sm text-light" value="{{ $invoice->labels->first()->item_qty_label }}" name="itemQtyLabel" required/>
                                    </div>
                                </div>
                                <div class="name">
                                    <div class="theme-label bordered">
                                        <input type="text" class="input-label  input-label-custom form-control form-control-sm text-light" value="{{ $invoice->labels->first()->item_desc_label }}" name="itemDescLabel"  required/>
                                    </div>
                                </div>
                            </div>
                            <div id="items" class="items-table">
                                @forelse($invoice->items as $key => $data )
                                <input type="hidden" name="itemId[]" value="{{ $data->id }}">
                                <div class="item-row pb-1">
                                    <div class="main-row">
                                        <div class="delete">
                                            @if($key != 0)
                                            <button class="btn btn-outline-danger btn-sm delete-btn"> <i class="fa fa-times"></i></button>
                                            @endif
                                        </div>
                                        <input type="hidden" name="itemAmount[]" class="amount_value" value="{{ $data->item_amount }}">
                                        <div  class="amount value amount_div">
                                            <span class="currency-symbol">{{ $invoice->currency == 'USD' ? '$' : '৳' }}</span>
                                            {{ $data->item_amount }}
                                        </div>
                                        <div class="unit_cost">
                                            <div class="input-group input-group-sm">
                                                <span  class="input-group-text pe-2 ps-2 currency-sign currency-symbol">$</span>
                                                <input  class="item-calc form-control form-control-sm border-start-0 ps-2 rate_input" type="number" step="any" autocomplete="off" name="itemRate[]" value="{{ $data->item_rate }}"  required/>
                                            </div>
                                        </div>
                                        <div class="quantity">
                                            <input  type="number" step="any" class="item-calc form-control form-control-sm quantity_input" autocomplete="off" name="itemQty[]" value="{{ $data->item_qty }}" required/>
                                        </div>
                                        <div class="name">
                                            <input class="item-calc form-control form-control-sm" rows="1" name="itemDesc[]" placeholder="Description of item/service..." value="{{ $data->item_desc }}" required>
                                        </div>
                                    </div>
                                </div>
                                @empty
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
                                                    <input  class="item-calc form-control form-control-sm border-start-0 ps-2 rate_input" type="number" step="any" autocomplete="off" name="itemRate[]" value="0"  required/>
                                                </div>
                                            </div>
                                            <div class="quantity">
                                                <input  type="number" step="any" class="item-calc form-control form-control-sm quantity_input" autocomplete="off" name="itemQty[]" value="0" required/>
                                            </div>
                                            <div class="name">
                                                <input class="item-calc form-control form-control-sm" rows="1" name="itemDesc[]" placeholder="Description of item/service..." required>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse


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
                                            <input type="text" class="input-label form-control form-control-sm" name="note_label" value="{{ $invoice->labels->first()->note_label }}" required    />
                                        </div>
                                        <div class="value">
                                            <textarea class="notes form-control form-control-sm" placeholder="Notes - any relevant information not already covered" name="note_value" >{{ $invoice->note_value }}</textarea>
                                        </div>
                                    </div>
                                    <div class="terms-holder mt-3">
                                        <div class="theme-label mb-1">
                                            <input type="text" class="input-label form-control form-control-sm" name="term_label" value="{{$invoice->labels->first()->term_label }}"  required/>
                                        </div>
                                        <div class="value">
                                            <textarea class="terms form-control form-control-sm" placeholder="Terms and conditions - late fees, payment methods, delivery schedule" name="term_value">{{ $invoice->term_value }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group addon-input">
                                    <input class="input-label form-control form-control-sm " type="text" name="subtotal_label" required value="{{ $invoice->labels->first()->subtotal_label }}" />
                                    <input type="hidden" name="subtotal_value" class="subtotal_value" value="{{ $invoice->subtotal_value }}">
                                    <div id="subtotal_div" class="input-group-addon value pr-5">
                                        <span class="currency-symbol">
                                           {{ $invoice->currency == 'USD' ? '$' : '৳' }}
                                        </span>
                                        {{ $invoice->subtotal_value }}
                                    </div>
                                </div>



                                <div class="input-group addon-input">
                                    <input class="input-label form-control form-control-sm" type="text" name="discount_label" value="{{ $invoice->labels->first()->discount_label}}" required />
                                    <div class="input-group-addon">
                                        <div class="input-group input-group-sm">
                                            <input id="discount_input" class="item-calc form-control  custom-input form-control-sm  ps-2" type="number" name="discount_value"   value="{{ $invoice->discount_value }}" style="border-right: none;" />
                                            <input type="hidden" name="discount_type" id="discount_type" value={{$invoice->discount_type}}>
                                            <div id="discount" class="percent-custom   " style="margin-right: 1px;">{{ $invoice->discount_type == 'amount' ? ($invoice->currency == 'USD' ? '$' : '৳'): '%' }}</div>
                                            <button id="exchange" type="button" class="btn btn-square btn-light " >
                                                <span  class="fa fa-exchange"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group addon-input">
                                    <input class="input-label form-control form-control-sm" type="text" name="tax_label" required value="{{ $invoice->labels->first()->tax_label }}" />

                                    <div class="input-group-addon">
                                        <div class="input-group input-group-sm">
                                            <input id="tax_input" class="item-calc form-control form-control-sm ps-2" type="number" name="tax_value" value="{{ $invoice->tax_value  }}" />

                                            <span class="input-group-text pe-2 ps-2 currency-sign curre">%</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="input-group addon-input">
                                    <input class="input-label form-control form-control-sm" type="text" name="total_label" value="{{ $invoice->labels->first()->total_label }}" />
                                    <input type="hidden" name="total_value" class="total_value" value="{{ $invoice->total_value }}">
                                    <div id="total_div" class="input-group-addon value pr-5 ">
                                    <span class="currency-symbol">
                                        {{ $invoice->discount_type == 'amount' ? ($invoice->currency == 'USD' ? '$' : '৳'): '%' }}
                                    </span>

                                    {{ $invoice->total_value }}
                                </div>
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
// document.addEventListener('DOMContentLoaded', function () {
//     var oldItems = @json(old('itemDesc', []));
//     var oldQtys = @json(old('itemQty', []));
//     var oldRates = @json(old('itemRate', []));
//     var oldAmounts = @json(old('itemAmount', []));

//     // Function to add a line item
//     function addLineItem(desc = '', qty = '0', rate = '0', amount = '0') {
//         const newItemHtml = `
//         <div class="item-row pb-1">
//             <div class="main-row">
//                 <div class="delete">
//                     <button class="btn btn-outline-danger btn-sm delete-btn"><i class="fa fa-times"></i></button>
//                 </div>
//                 <input type="hidden" name="itemAmount[]" class="amount_value" value="${amount}">
//                 <div class="amount value amount_div">
//                     <span class="currency-symbol">$</span>
//                     ${amount}
//                 </div>
//                 <div class="unit_cost">
//                     <div class="input-group input-group-sm">
//                         <span class="input-group-text pe-2 ps-2 currency-sign currency-symbol">$</span>
//                         <input class="item-calc form-control form-control-sm border-start-0 ps-2 rate_input" type="number" step="any" autocomplete="off" name="itemRate[]" value="${rate}" required/>
//                     </div>
//                 </div>
//                 <div class="quantity">
//                     <input type="number" step="any" class="item-calc form-control form-control-sm quantity_input" autocomplete="off" name="itemQty[]" value="${qty}" required />
//                 </div>
//                 <div class="name">
//                     <input class="item-calc form-control form-control-sm" name="itemDesc[]" placeholder="Description of item/service..." value="${desc}" required>
//                 </div>
//             </div>
//         </div>`;
//         $('#items').append(newItemHtml);
//     }

//     // Add existing old items
//     if (oldItems.length) {
//         oldItems.forEach((desc, index) => {
//             addLineItem(desc, oldQtys[index], oldRates[index], oldAmounts[index]);
//         });
//     }

//     // Button to add new blank item row
//     $('#addLineItemBtn').click(function() {
//         addLineItem();
//     });
// });

  // Listen for changes on the client dropdown

  $('select[name="client_id"]').change(function() {
        let projects = @json($projects);
        let selectedClientId = $(this).val();
        let name = $(this).find(':selected').text();

        $('#to').val(name === 'None' ? '' : name);
        $('#project-select').empty().append($('<option>', { value: 'none', text: 'None', selected: true }));

        if (selectedClientId == 'none') {
            $('.project').addClass('d-none');
        } else {
            let clientProjects = projects.filter(project => project.client_id == selectedClientId);
            $('.project').toggleClass('d-none', clientProjects.length === 0);
            clientProjects.forEach(project => {
                $('#project-select').append($('<option>', {
                    value: project.id,
                    text: project.name,
                    selected: @json($invoice->project_id) == project.id
                }));
            });
        }
    });

    // Trigger the change event on page load if client_id is set
    if ($('select[name="client_id"]').val() !== 'none') {
        $('select[name="client_id"]').trigger('change');
    }


    $(document).ready(function() {
    var currentCurrencySymbol = '$'; // Initialize with default currency symbol

    // Function to update the currency symbols based on selection
    function updateCurrencySymbols(currency) {
        currentCurrencySymbol = currency === "USD" ? '$' : '৳';
        $('.currency-symbol').text(currentCurrencySymbol);
    }

    function updateAmount(itemRow) {
    var rate = parseFloat($(itemRow).find('.rate_input').val()) || 0;
    var quantity = parseFloat($(itemRow).find('.quantity_input').val()) || 0;
    var amount = rate * quantity;
    $(itemRow).find('.amount_div').html(`<span class="currency-symbol">${currentCurrencySymbol}</span>${amount.toFixed(2)}`);
    $(itemRow).find('.amount_value').val(amount.toFixed(2));  // Ensure this value is being set correctly
    updateSubtotal();
}

    function updateSubtotal() {
    var subtotal = 0;
    $('.amount_value').each(function() {
        subtotal += parseFloat($(this).val()) || 0;  // Make sure you're parsing the float value correctly
    });
    $('#subtotal_div').html(`<span class="currency-symbol">${currentCurrencySymbol}</span>${subtotal.toFixed(2)}`);
    $('.subtotal_value').val(subtotal.toFixed(2));  // Make sure this input exists and is being updated
    calculateDiscountAndTax();  // Update discount and tax based on the new subtotal
}

    // Function to calculate and update the discount, tax, and total
    function calculateDiscountAndTax() {
        var subtotal = parseFloat($('.subtotal_value').val());
        var discountValue = parseFloat($('#discount_input').val()) || 0;
        var taxRate = parseFloat($('#tax_input').val()) || 0;
        var discountAmount = 0;
        var taxAmount = 0;

        if ($('#discount').text().trim() === '%') {
            discountAmount = subtotal * discountValue / 100;
        } else {
            discountAmount = discountValue;
        }

        var totalAfterDiscount = subtotal - discountAmount;
        taxAmount = totalAfterDiscount * taxRate / 100;
        var total = totalAfterDiscount + taxAmount;

        $('#total_div').html(`<span class="currency-symbol">${currentCurrencySymbol}</span>${total.toFixed(2)}`);
        $('.total_value').val(total.toFixed(2));
    }

    // Event listeners
    $('#items').on('input', '.rate_input, .quantity_input', function() {
        var itemRow = $(this).closest('.main-row');
        updateAmount(itemRow);
    });

    $('#discount_input, #tax_input').on('input', calculateDiscountAndTax);

    $('select[name="currency"]').change(function() {
        updateCurrencySymbols($(this).val());
    });

    $('#addLineItemBtn').click(function() {
        var newItemHtml = `
            <div class="item-row pb-1">
                <div class="main-row">
                    <div class="delete">
                        <button class="btn btn-outline-danger btn-sm delete-btn"><i class="fa fa-times"></i></button>
                    </div>
                    <input type="hidden" name="itemAmount[]" class="amount_value">
                    <div class="amount value amount_div">
                        <span class="currency-symbol">${currentCurrencySymbol}</span>0
                    </div>
                    <div class="unit_cost">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text pe-2 ps-2 currency-sign currency-symbol">${currentCurrencySymbol}</span>
                            <input class="item-calc form-control form-control-sm border-start-0 ps-2 rate_input" type="number" step="any" autocomplete="off" name="itemRate[]" required/>
                        </div>
                    </div>
                    <div class="quantity">
                        <input type="number" step="any" class="item-calc form-control form-control-sm quantity_input" autocomplete="off" name="itemQty[]" required />
                    </div>
                    <div class="name">
                        <input class="item-calc form-control form-control-sm" rows="1" name="itemDesc[]" placeholder="Description of item/service..." required>
                    </div>
                </div>
            </div>`;
        $('#items').append(newItemHtml);
    });

    $('#items').on('click', '.delete-btn', function() {
        $(this).closest('.item-row').remove();
        updateSubtotal(); // Recalculate subtotal when an item is removed
    });

    // Initialize the form with default values
    updateCurrencySymbols($('select[name="currency"]').val());
    if ($('select[name="client_id"]').val() !== 'none') {
        $('select[name="client_id"]').trigger('change');
    }
});



</script>
    <!-- Datatable -->

@endsection
