@extends('dashboard.layouts.app')
@section('style')

<link rel="stylesheet" href="https://cdn.invoice-generator.com/theme_light.9ae229e2.css" id="theme-link">
<link rel="stylesheet" href="https://cdn.invoice-generator.com/197.655399c9.css"><link rel="stylesheet" href="https://cdn.invoice-generator.com/app.bc26e048.css">
<style>
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
                                                                                <option value="AED" >AED</option>
                                                                                <option value="AFN" >AFN</option>
                                                                                <option value="ALL" >ALL</option>
                                                                                <option value="AMD" >AMD</option>
                                                                                <option value="ANG" >ANG</option>
                                                                                <option value="AOA" >AOA</option>
                                                                                <option value="ARS" >ARS</option>
                                                                                <option value="AUD" >AUD</option>
                                                                                <option value="AWG" >AWG</option>
                                                                                <option value="AZN" >AZN</option>
                                                                                <option value="BAM" >BAM</option>
                                                                                <option value="BBD" >BBD</option>
                                                                                <option value="BDT" >BDT</option>
                                                                                <option value="BGN" >BGN</option>
                                                                                <option value="BHD" >BHD</option>
                                                                                <option value="BIF" >BIF</option>
                                                                                <option value="BMD" >BMD</option>
                                                                                <option value="BND" >BND</option>
                                                                                <option value="BOB" >BOB</option>
                                                                                <option value="BOV" >BOV</option>
                                                                                <option value="BRL" >BRL</option>
                                                                                <option value="BSD" >BSD</option>
                                                                                <option value="BTN" >BTN</option>
                                                                                <option value="BWP" >BWP</option>
                                                                                <option value="BYN" >BYN</option>
                                                                                <option value="BZD" >BZD</option>
                                                                                <option value="CAD" >CAD</option>
                                                                                <option value="CDF" >CDF</option>
                                                                                <option value="CHE" >CHE</option>
                                                                                <option value="CHF" >CHF</option>
                                                                                <option value="CHW" >CHW</option>
                                                                                <option value="CLF" >CLF</option>
                                                                                <option value="CLP" >CLP</option>
                                                                                <option value="CNY" >CNY</option>
                                                                                <option value="COP" >COP</option>
                                                                                <option value="COU" >COU</option>
                                                                                <option value="CRC" >CRC</option>
                                                                                <option value="CUC" >CUC</option>
                                                                                <option value="CUP" >CUP</option>
                                                                                <option value="CVE" >CVE</option>
                                                                                <option value="CZK" >CZK</option>
                                                                                <option value="DJF" >DJF</option>
                                                                                <option value="DKK" >DKK</option>
                                                                                <option value="DOP" >DOP</option>
                                                                                <option value="DZD" >DZD</option>
                                                                                <option value="EGP" >EGP</option>
                                                                                <option value="ERN" >ERN</option>
                                                                                <option value="ETB" >ETB</option>
                                                                                <option value="EUR" >EUR</option>
                                                                                <option value="FJD" >FJD</option>
                                                                                <option value="FKP" >FKP</option>
                                                                                <option value="GBP" >GBP</option>
                                                                                <option value="GEL" >GEL</option>
                                                                                <option value="GHS" >GHS</option>
                                                                                <option value="GIP" >GIP</option>
                                                                                <option value="GMD" >GMD</option>
                                                                                <option value="GNF" >GNF</option>
                                                                                <option value="GTQ" >GTQ</option>
                                                                                <option value="GYD" >GYD</option>
                                                                                <option value="HKD" >HKD</option>
                                                                                <option value="HNL" >HNL</option>
                                                                                <option value="HTG" >HTG</option>
                                                                                <option value="HUF" >HUF</option>
                                                                                <option value="IDR" >IDR</option>
                                                                                <option value="ILS" >ILS</option>
                                                                                <option value="INR" >INR</option>
                                                                                <option value="IQD" >IQD</option>
                                                                                <option value="IRR" >IRR</option>
                                                                                <option value="ISK" >ISK</option>
                                                                                <option value="JMD" >JMD</option>
                                                                                <option value="JOD" >JOD</option>
                                                                                <option value="JPY" >JPY</option>
                                                                                <option value="KES" >KES</option>
                                                                                <option value="KGS" >KGS</option>
                                                                                <option value="KHR" >KHR</option>
                                                                                <option value="KMF" >KMF</option>
                                                                                <option value="KPW" >KPW</option>
                                                                                <option value="KRW" >KRW</option>
                                                                                <option value="KWD" >KWD</option>
                                                                                <option value="KYD" >KYD</option>
                                                                                <option value="KZT" >KZT</option>
                                                                                <option value="LAK" >LAK</option>
                                                                                <option value="LBP" >LBP</option>
                                                                                <option value="LKR" >LKR</option>
                                                                                <option value="LRD" >LRD</option>
                                                                                <option value="LSL" >LSL</option>
                                                                                <option value="LYD" >LYD</option>
                                                                                <option value="MAD" >MAD</option>
                                                                                <option value="MDL" >MDL</option>
                                                                                <option value="MGA" >MGA</option>
                                                                                <option value="MKD" >MKD</option>
                                                                                <option value="MMK" >MMK</option>
                                                                                <option value="MNT" >MNT</option>
                                                                                <option value="MOP" >MOP</option>
                                                                                <option value="MRU" >MRU</option>
                                                                                <option value="MUR" >MUR</option>
                                                                                <option value="MVR" >MVR</option>
                                                                                <option value="MWK" >MWK</option>
                                                                                <option value="MXN" >MXN</option>
                                                                                <option value="MXV" >MXV</option>
                                                                                <option value="MYR" >MYR</option>
                                                                                <option value="MZN" >MZN</option>
                                                                                <option value="NAD" >NAD</option>
                                                                                <option value="NGN" >NGN</option>
                                                                                <option value="NIO" >NIO</option>
                                                                                <option value="NOK" >NOK</option>
                                                                                <option value="NPR" >NPR</option>
                                                                                <option value="NZD" >NZD</option>
                                                                                <option value="OMR" >OMR</option>
                                                                                <option value="PAB" >PAB</option>
                                                                                <option value="PEN" >PEN</option>
                                                                                <option value="PGK" >PGK</option>
                                                                                <option value="PHP" >PHP</option>
                                                                                <option value="PKR" >PKR</option>
                                                                                <option value="PLN" >PLN</option>
                                                                                <option value="PYG" >PYG</option>
                                                                                <option value="QAR" >QAR</option>
                                                                                <option value="RON" >RON</option>
                                                                                <option value="RSD" >RSD</option>
                                                                                <option value="RUB" >RUB</option>
                                                                                <option value="RWF" >RWF</option>
                                                                                <option value="SAR" >SAR</option>
                                                                                <option value="SBD" >SBD</option>
                                                                                <option value="SCR" >SCR</option>
                                                                                <option value="SDG" >SDG</option>
                                                                                <option value="SEK" >SEK</option>
                                                                                <option value="SGD" >SGD</option>
                                                                                <option value="SHP" >SHP</option>
                                                                                <option value="SLE" >SLE</option>
                                                                                <option value="SOS" >SOS</option>
                                                                                <option value="SRD" >SRD</option>
                                                                                <option value="SSP" >SSP</option>
                                                                                <option value="STN" >STN</option>
                                                                                <option value="SVC" >SVC</option>
                                                                                <option value="SYP" >SYP</option>
                                                                                <option value="SZL" >SZL</option>
                                                                                <option value="THB" >THB</option>
                                                                                <option value="TJS" >TJS</option>
                                                                                <option value="TMT" >TMT</option>
                                                                                <option value="TND" >TND</option>
                                                                                <option value="TOP" >TOP</option>
                                                                                <option value="TRY" >TRY</option>
                                                                                <option value="TTD" >TTD</option>
                                                                                <option value="TWD" >TWD</option>
                                                                                <option value="TZS" >TZS</option>
                                                                                <option value="UAH" >UAH</option>
                                                                                <option value="UGX" >UGX</option>
                                                                                <option value="USD" selected="selected">USD</option>
                                                                                <option value="USN" >USN</option>
                                                                                <option value="UYI" >UYI</option>
                                                                                <option value="UYU" >UYU</option>
                                                                                <option value="UYW" >UYW</option>
                                                                                <option value="UZS" >UZS</option>
                                                                                <option value="VED" >VED</option>
                                                                                <option value="VES" >VES</option>
                                                                                <option value="VND" >VND</option>
                                                                                <option value="VUV" >VUV</option>
                                                                                <option value="WST" >WST</option>
                                                                                <option value="XAF" >XAF</option>
                                                                                <option value="XAG" >XAG</option>
                                                                                <option value="XAU" >XAU</option>
                                                                                <option value="XBA" >XBA</option>
                                                                                <option value="XBB" >XBB</option>
                                                                                <option value="XBC" >XBC</option>
                                                                                <option value="XBD" >XBD</option>
                                                                                <option value="XCD" >XCD</option>
                                                                                <option value="XDR" >XDR</option>
                                                                                <option value="XOF" >XOF</option>
                                                                                <option value="XPD" >XPD</option>
                                                                                <option value="XPF" >XPF</option>
                                                                                <option value="XPT" >XPT</option>
                                                                                <option value="XSU" >XSU</option>
                                                                                <option value="XTS" >XTS</option>
                                                                                <option value="XUA" >XUA</option>
                                                                                <option value="XXX" >XXX</option>
                                                                                <option value="YER" >YER</option>
                                                                                <option value="ZAR" >ZAR</option>
                                                                                <option value="ZMW" >ZMW</option>
                                                                                <option value="ZWL" >ZWL</option>
                                                                        </select>
                            </div>
                        </div>

                        {{-- <div class="mt-3">
                            <label class="control-label">Tax</label>
                            <div>
                                <select class="form-select" name="fields[tax]">
                                    <option value="%">Percent (%)</option>
                                    <option value="1">Flat Amount ($)</option>
                                    <option value="0">Off</option>
                                </select>
                            </div>
                        </div> --}}

                        {{-- <div class="mt-3">
                            <label class="control-label">Shipping</label>
                            <div>
                                <select class="form-select" name="fields[shipping]">
                                    <option value="1">Flat Amount ($)</option>
                                    <option value="0">Off</option>
                                </select>
                            </div>
                        </div> --}}

                        {{-- <div class="mt-3">
                            <label class="control-label">Discount</label>
                            <div>
                                <select class="form-select" name="fields[discounts]">
                                    <option value="%">Percent (%)</option>
                                    <option value="1">Flat Amount ($)</option>
                                    <option value="0">Off</option>
                                </select>
                            </div>
                        </div> --}}
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
                                    {{-- <div class="subtitle">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text pe-2 ps-2">#</span>
                                            <input class="form-control form-control-sm border-start-0 ps-2" type="text" name="number" />
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            {{-- <div class="row">
                                <div class="col-md-8">
                                    <div class="contact">
                                        <div class="theme-label mb-1">
                                            <input type="text" class="input-label form-control form-control-sm" name="from_title" value="Bill From" />
                                        </div>
                                        <div class="value">
                                            <textarea class="form-control form-control-sm" placeholder="Who is this from?" name="from"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

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
                                {{-- <div class="col-md-6">
                                    <div class="contact pt-3">
                                        <div class="theme-label mb-1">
                                            <input type="text" class="input-label form-control form-control-sm" name="ship_to_title" value="Ship To" />
                                        </div>
                                        <div class="value">
                                            <textarea class="form-control form-control-sm" placeholder="(optional)" name="ship_to"></textarea>
                                        </div>
                                    </div>
                                </div> --}}
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

                                <!-- PO # -->
                                {{-- <div class="input-group addon-input" ng-hide="document.type == 'purchase_order'">
                                    <input class="input-label form-control form-control-sm" type="text" name="purchase_order_title" value="PO Number" />
                                    <div class="input-group-addon">
                                        <input id="invoiceDueDate" class="form-control form-control-sm datepicker" type="text" name="purchase_order" />
                                    </div>
                                </div> --}}

                                {{-- <!-- Balance -->
                                <div class="input-group addon-input highlight">
                                    <input class="input-label form-control form-control-sm" type="text" name="balance_title" value="Balance Due" />
                                    <div class="input-group-addon value"><span class="currency-symbol">$</span>0</div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="items-holder">
                        <div class="items-table-header rounded-1   mb-1" style="background: #3b82f6;">
                            <div class="amount">
                                <div class="theme-label bordered">
                                    <input type="text" class="input-label input-label-custom form-control form-control-sm text-light" value="Amount" name="amount_header" />
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
                        <div class="items-table">
                            <div class="item-row pb-1">
                                <div class="main-row">
                                    <div class="delete"></div>
                                    <div class="amount value">
                                        <span class="currency-symbol">$</span>0
                                    </div>
                                    <div class="unit_cost">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text pe-2 ps-2 currency-sign">$</span>
                                            <input class="item-calc form-control form-control-sm border-start-0 ps-2" type="number" step="any" autocomplete="off" name="items[0][unit_cost]" value="0" />
                                        </div>
                                    </div>
                                    <div class="quantity">
                                        <input type="number" step="any" class="item-calc form-control form-control-sm" autocomplete="off" name="items[0][quantity]" value="0" />
                                    </div>
                                    <div class="name">
                                        <textarea class="item-calc form-control form-control-sm" rows="1" name="items[0][name]" placeholder="Description of item/service..."></textarea>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="new-line">
                            <button type="button" class="btn line-item btn-sm ng-binding" tabindex="1000" ng-click="addLineItem()" style="border: .5px solid #3b82f6; color :#3b82f6">
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
                                <input class="input-label form-control form-control-sm" type="text" name="subtotal_title" value="Subtotal" />
                                <div class="input-group-addon value"><span class="currency-symbol">$</span>0</div>
                            </div>

                            {{-- <div class="input-group addon-input">
                                <input class="input-label form-control form-control-sm" type="text" name="discounts_title" value="Discount" />
                                <div class="input-group-addon">
                                    <input type="text" class="form-control form-control-sm" name="discounts" value="0" />
                                </div>
                            </div> --}}

                            <div class="input-group addon-input mt-1" ng-show="!!document.fields.discounts">

                                <input class="input-label form-control form-control-sm ng-pristine ng-untouched ng-valid" type="text" ng-model="document.discounts_title" tabindex="1002" value="Discount">
                                <div class="input-group-addon input deleteable">
                                    <div input-amount="" is-rate="discountIsRate" currency="document.currency" ng-model="document.discounts" ng-tabindex="1003" has-selector="true" class="ng-pristine ng-untouched ng-valid ng-isolate-scope">
                                        <div class="input-group input-group-sm">
                                            <!-- ngIf: !isRate -->
                                            <input type="text" class="form-control form-control-sm border-start-0 ps-2" name="shipping" value="0" />
                                            <!-- ngIf: !!isRate -->
                                            <div class="input-group-text ps-2 pe-2 ng-scope" ng-if="!!isRate">%</div>
                                            <!-- end ngIf: !!isRate --><!-- ngIf: hasSelector -->
                                            <button type="button" class="btn btn-outline-secondary ng-scope" ng-click="toggleRate()" ng-if="hasSelector">
                                                <span class="fa fa-repeat"></span>
                                            </button><!-- end ngIf: hasSelector -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group addon-input">
                                <input class="input-label form-control form-control-sm" type="text" name="tax_title" value="Tax" />
                                <div class="input-group-addon">
                                    <input type="text" class="form-control form-control-sm" name="tax" value="0" />
                                </div>
                            </div>

                            {{-- <div class="input-group addon-input">
                                <input class="input-label form-control form-control-sm" type="text" name="shipping_title" value="Discount" />
                                <div class="input-group-addon">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control form-control-sm border-start-0 ps-2" name="shipping" value="0" />
                                        <span class="input-group-text pe-2 ps-2 currency-sign">%</span>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="input-group addon-input">
                                <input class="input-label form-control form-control-sm" type="text" name="shipping_title" value="Shipping" />
                                <div class="input-group-addon">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text pe-2 ps-2 currency-sign">$</span>
                                        <input type="text" class="form-control form-control-sm border-start-0 ps-2" name="shipping" value="0" />
                                    </div>
                                </div>
                            </div> --}}

                            <div class="input-group addon-input">
                                <input class="input-label form-control form-control-sm" type="text" name="total_title" value="Total" />
                                <div class="input-group-addon value"><span class="currency-symbol">$</span>0</div>
                            </div>

                            {{-- <div class="input-group addon-input">
                                <input class="input-label form-control form-control-sm" type="text" name="amount_paid_title" value="Amount Paid" />
                                <div class="input-group-addon">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text pe-2 ps-2 currency-sign">$</span>
                                        <input type="text" class="form-control form-control-sm border-start-0 ps-2" name="amount_paid" value="0" />
                                    </div>
                                </div>
                            </div> --}}
                              <!-- Balance -->
                                <div class="input-group addon-input ">
                                    <input class="input-label form-control form-control-sm" type="text" name="balance_title" value="Balance Due" />
                                    <div class="input-group-addon value"><span class="currency-symbol">$</span>0</div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="invoice-controls mobile">
                <div class="d-none d-md-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50 m-2">
                        <span class="fas fa-arrow-to-bottom"></span> Download Invoice
                    </button>
                </div>

                <div class="mt-3">
                    <label class="control-label">Currency</label>
                    <div>
                        <select class="form-select" name="currency">
                                                                <option value="AED" >AED</option>
                                                                <option value="AFN" >AFN</option>
                                                                <option value="ALL" >ALL</option>
                                                                <option value="AMD" >AMD</option>
                                                                <option value="ANG" >ANG</option>
                                                                <option value="AOA" >AOA</option>
                                                                <option value="ARS" >ARS</option>
                                                                <option value="AUD" >AUD</option>
                                                                <option value="AWG" >AWG</option>
                                                                <option value="AZN" >AZN</option>
                                                                <option value="BAM" >BAM</option>
                                                                <option value="BBD" >BBD</option>
                                                                <option value="BDT" >BDT</option>
                                                                <option value="BGN" >BGN</option>
                                                                <option value="BHD" >BHD</option>
                                                                <option value="BIF" >BIF</option>
                                                                <option value="BMD" >BMD</option>
                                                                <option value="BND" >BND</option>
                                                                <option value="BOB" >BOB</option>
                                                                <option value="BOV" >BOV</option>
                                                                <option value="BRL" >BRL</option>
                                                                <option value="BSD" >BSD</option>
                                                                <option value="BTN" >BTN</option>
                                                                <option value="BWP" >BWP</option>
                                                                <option value="BYN" >BYN</option>
                                                                <option value="BZD" >BZD</option>
                                                                <option value="CAD" >CAD</option>
                                                                <option value="CDF" >CDF</option>
                                                                <option value="CHE" >CHE</option>
                                                                <option value="CHF" >CHF</option>
                                                                <option value="CHW" >CHW</option>
                                                                <option value="CLF" >CLF</option>
                                                                <option value="CLP" >CLP</option>
                                                                <option value="CNY" >CNY</option>
                                                                <option value="COP" >COP</option>
                                                                <option value="COU" >COU</option>
                                                                <option value="CRC" >CRC</option>
                                                                <option value="CUC" >CUC</option>
                                                                <option value="CUP" >CUP</option>
                                                                <option value="CVE" >CVE</option>
                                                                <option value="CZK" >CZK</option>
                                                                <option value="DJF" >DJF</option>
                                                                <option value="DKK" >DKK</option>
                                                                <option value="DOP" >DOP</option>
                                                                <option value="DZD" >DZD</option>
                                                                <option value="EGP" >EGP</option>
                                                                <option value="ERN" >ERN</option>
                                                                <option value="ETB" >ETB</option>
                                                                <option value="EUR" >EUR</option>
                                                                <option value="FJD" >FJD</option>
                                                                <option value="FKP" >FKP</option>
                                                                <option value="GBP" >GBP</option>
                                                                <option value="GEL" >GEL</option>
                                                                <option value="GHS" >GHS</option>
                                                                <option value="GIP" >GIP</option>
                                                                <option value="GMD" >GMD</option>
                                                                <option value="GNF" >GNF</option>
                                                                <option value="GTQ" >GTQ</option>
                                                                <option value="GYD" >GYD</option>
                                                                <option value="HKD" >HKD</option>
                                                                <option value="HNL" >HNL</option>
                                                                <option value="HTG" >HTG</option>
                                                                <option value="HUF" >HUF</option>
                                                                <option value="IDR" >IDR</option>
                                                                <option value="ILS" >ILS</option>
                                                                <option value="INR" >INR</option>
                                                                <option value="IQD" >IQD</option>
                                                                <option value="IRR" >IRR</option>
                                                                <option value="ISK" >ISK</option>
                                                                <option value="JMD" >JMD</option>
                                                                <option value="JOD" >JOD</option>
                                                                <option value="JPY" >JPY</option>
                                                                <option value="KES" >KES</option>
                                                                <option value="KGS" >KGS</option>
                                                                <option value="KHR" >KHR</option>
                                                                <option value="KMF" >KMF</option>
                                                                <option value="KPW" >KPW</option>
                                                                <option value="KRW" >KRW</option>
                                                                <option value="KWD" >KWD</option>
                                                                <option value="KYD" >KYD</option>
                                                                <option value="KZT" >KZT</option>
                                                                <option value="LAK" >LAK</option>
                                                                <option value="LBP" >LBP</option>
                                                                <option value="LKR" >LKR</option>
                                                                <option value="LRD" >LRD</option>
                                                                <option value="LSL" >LSL</option>
                                                                <option value="LYD" >LYD</option>
                                                                <option value="MAD" >MAD</option>
                                                                <option value="MDL" >MDL</option>
                                                                <option value="MGA" >MGA</option>
                                                                <option value="MKD" >MKD</option>
                                                                <option value="MMK" >MMK</option>
                                                                <option value="MNT" >MNT</option>
                                                                <option value="MOP" >MOP</option>
                                                                <option value="MRU" >MRU</option>
                                                                <option value="MUR" >MUR</option>
                                                                <option value="MVR" >MVR</option>
                                                                <option value="MWK" >MWK</option>
                                                                <option value="MXN" >MXN</option>
                                                                <option value="MXV" >MXV</option>
                                                                <option value="MYR" >MYR</option>
                                                                <option value="MZN" >MZN</option>
                                                                <option value="NAD" >NAD</option>
                                                                <option value="NGN" >NGN</option>
                                                                <option value="NIO" >NIO</option>
                                                                <option value="NOK" >NOK</option>
                                                                <option value="NPR" >NPR</option>
                                                                <option value="NZD" >NZD</option>
                                                                <option value="OMR" >OMR</option>
                                                                <option value="PAB" >PAB</option>
                                                                <option value="PEN" >PEN</option>
                                                                <option value="PGK" >PGK</option>
                                                                <option value="PHP" >PHP</option>
                                                                <option value="PKR" >PKR</option>
                                                                <option value="PLN" >PLN</option>
                                                                <option value="PYG" >PYG</option>
                                                                <option value="QAR" >QAR</option>
                                                                <option value="RON" >RON</option>
                                                                <option value="RSD" >RSD</option>
                                                                <option value="RUB" >RUB</option>
                                                                <option value="RWF" >RWF</option>
                                                                <option value="SAR" >SAR</option>
                                                                <option value="SBD" >SBD</option>
                                                                <option value="SCR" >SCR</option>
                                                                <option value="SDG" >SDG</option>
                                                                <option value="SEK" >SEK</option>
                                                                <option value="SGD" >SGD</option>
                                                                <option value="SHP" >SHP</option>
                                                                <option value="SLE" >SLE</option>
                                                                <option value="SOS" >SOS</option>
                                                                <option value="SRD" >SRD</option>
                                                                <option value="SSP" >SSP</option>
                                                                <option value="STN" >STN</option>
                                                                <option value="SVC" >SVC</option>
                                                                <option value="SYP" >SYP</option>
                                                                <option value="SZL" >SZL</option>
                                                                <option value="THB" >THB</option>
                                                                <option value="TJS" >TJS</option>
                                                                <option value="TMT" >TMT</option>
                                                                <option value="TND" >TND</option>
                                                                <option value="TOP" >TOP</option>
                                                                <option value="TRY" >TRY</option>
                                                                <option value="TTD" >TTD</option>
                                                                <option value="TWD" >TWD</option>
                                                                <option value="TZS" >TZS</option>
                                                                <option value="UAH" >UAH</option>
                                                                <option value="UGX" >UGX</option>
                                                                <option value="USD" selected="selected">USD</option>
                                                                <option value="USN" >USN</option>
                                                                <option value="UYI" >UYI</option>
                                                                <option value="UYU" >UYU</option>
                                                                <option value="UYW" >UYW</option>
                                                                <option value="UZS" >UZS</option>
                                                                <option value="VED" >VED</option>
                                                                <option value="VES" >VES</option>
                                                                <option value="VND" >VND</option>
                                                                <option value="VUV" >VUV</option>
                                                                <option value="WST" >WST</option>
                                                                <option value="XAF" >XAF</option>
                                                                <option value="XAG" >XAG</option>
                                                                <option value="XAU" >XAU</option>
                                                                <option value="XBA" >XBA</option>
                                                                <option value="XBB" >XBB</option>
                                                                <option value="XBC" >XBC</option>
                                                                <option value="XBD" >XBD</option>
                                                                <option value="XCD" >XCD</option>
                                                                <option value="XDR" >XDR</option>
                                                                <option value="XOF" >XOF</option>
                                                                <option value="XPD" >XPD</option>
                                                                <option value="XPF" >XPF</option>
                                                                <option value="XPT" >XPT</option>
                                                                <option value="XSU" >XSU</option>
                                                                <option value="XTS" >XTS</option>
                                                                <option value="XUA" >XUA</option>
                                                                <option value="XXX" >XXX</option>
                                                                <option value="YER" >YER</option>
                                                                <option value="ZAR" >ZAR</option>
                                                                <option value="ZMW" >ZMW</option>
                                                                <option value="ZWL" >ZWL</option>
                                                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- <div class="ng-cloak">
        <div ng-controller="DocumentEditorController">

                <form name="documentForm">
                    <div class="invoice-holder clearfix">
                        <div class="mobile-btns bg-white border-top">
                            <div class="inner">
                                <div class="right">
                                    <button type="button" class="btn btn-primary" ng-disabled="documentForm.$invalid" ng-click="saveAndDownloadPDF()">
                                        <span ng-show="cloudMode"><span ng-show="isExisting">{{translations['labels.save']}}</span><span ng-hide="isExisting">{{translations['labels.create']}}</span></span>
                                        <span ng-hide="cloudMode"><span class="fas fa-arrow-to-bottom"></span> {{translations['labels.download']}}</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="invoice-controls desktop">
                            <div class="affix-el" id="invoice-controls-affix">
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-primary" ng-disabled="documentForm.$invalid" ng-click="saveAndDownloadPDF()" tabindex="1051">
                                        <span ng-show="cloudMode"><span ng-show="isExisting">{{translations['labels.save']}}</span><span ng-hide="isExisting">{{translations['labels.create']}}</span></span>
                                        <span ng-hide="cloudMode"><span class="fas fa-arrow-to-bottom"></span> {{translations['labels.download']}}</span>
                                    </button>
                                </div>

                                <div class="border-top border-bottom px-3 mt-5">
                                    <div class="mt-3">
                                        <label class="control-label">{{translations['labels.currency']}}</label>
                                        <div class="mt-1">
                                            <select class="form-select form-select-sm" ng-model="document.currency" ng-options="currency.code as currency.name for (code, currency) in currencies"></select>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <a href="" ng-click="saveDefaults()" ng-show="!isDefault()" tabindex="1054" class="btn btn-link d-block">
                                            {{translations['labels.save_default']}}
                                        </a>
                                    </div>
                                </div>

                                <div id="adngin-side_1-0"></div>
                            </div>
                        </div>

                        <div class="papers">
                            <div class="invoice-editor">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="logo noselect">
                                            <div class="placeholder" ng-hide="document.logo">
                                                <div class="main"><span class="fas fa-plus"></span> {{translations['labels.add_your_logo']}}</div>
                                            </div>
                                            <img ng-show="document.logo" ng-src="{{document.logo}}" alt="Your Logo" />
                                            <input type="file" accept="image/*" class="file-1" onchange="angular.element(this).scope().changeLogo(this)" tabindex="12" />
                                            <input type="file" accept="image/*" class="file-2" onchange="angular.element(this).scope().changeLogo(this)" />
                                            <input type="file" accept="image/*" class="file-3" onchange="angular.element(this).scope().changeLogo(this)" />
                                            <input type="file" accept="image/*" class="file-4" onchange="angular.element(this).scope().changeLogo(this)" />
                                            <input type="file" accept="image/*" class="file-5" onchange="angular.element(this).scope().changeLogo(this)" />
                                            <input type="file" accept="image/*" class="file-6" onchange="angular.element(this).scope().changeLogo(this)" />
                                            <input type="file" accept="image/*" class="file-7" onchange="angular.element(this).scope().changeLogo(this)" />
                                            <input type="file" accept="image/*" class="file-8" onchange="angular.element(this).scope().changeLogo(this)" />
                                            <button class="remove-logo" ng-show="document.logo" ng-click="removeLogo()" tabindex="13">
                                                <span class="fas fa-times"></span>
                                            </button>
                                        </div>

                                        <div class="logo-not-supported alert alert-warning">
                                            <span class="fas fa-exclamation-triangle"></span>
                                            Uploading logos is not supported by your browser. Please consider <a href="https://firefox.com" target="_blank">upgrading</a>.
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="title">
                                            <input type="text" class="form-control input-label text-dark" ng-model="document.header" tabindex="10" ng-show="document.type === 'invoice'" />
                                            <input type="text" class="form-control input-label text-dark" ng-model="document.credit_note_header" tabindex="10" ng-show="document.type === 'credit_note'" />
                                            <input type="text" class="form-control input-label text-dark" ng-model="document.quote_header" tabindex="10" ng-show="document.type === 'quote'" />
                                            <input type="text" class="form-control input-label text-dark" ng-model="document.purchase_order_header" tabindex="10" ng-show="document.type === 'purchase_order'" />
                                            <div class="subtitle">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">#</span>
                                                    <input class="form-control border-start-0 ps-0" type="text" tabindex="11" ng-model="document.number" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="contact">
                                                    <div class="value">
                                                        <textarea class="form-control form-control-sm" placeholder="{{translations['placeholders.bill_from']}}" ng-model="document.from" tabindex="15" required expanding-textarea></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="contact pt-3">
                                                    <div class="theme-label mb-1">
                                                        <input type="text" class="input-label form-control form-control-sm" ng-model="document.to_title" tabindex="16" />
                                                    </div>
                                                    <div class="value">
                                                        <textarea class="form-control form-control-sm" placeholder="{{translations['placeholders.bill_to']}}" ng-model="document.to" tabindex="17" required expanding-textarea></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="contact pt-3">
                                                    <div class="theme-label mb-1">
                                                        <input type="text" class="input-label form-control form-control-sm" ng-model="document.ship_to_title" tabindex="18" />
                                                    </div>
                                                    <div class="value">
                                                        <textarea class="form-control form-control-sm" placeholder="{{translations['placeholders.ship_to']}}" ng-model="document.ship_to" tabindex="19" expanding-textarea></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="invoice-details pt-3">
                                            <!-- Date -->
                                            <div class="input-group addon-input">
                                                <input class="input-label form-control form-control-sm" type="text" ng-model="document.date_title" tabindex="20" />
                                                <div class="input-group-addon">
                                                    <input class="form-control form-control-sm datepicker date" type="text" ng-model="document.date" tabindex="21" date-picker />
                                                </div>
                                            </div>

                                            <!-- Payment Terms -->
                                            <div class="input-group addon-input mt-1">
                                                <input class="input-label form-control form-control-sm" type="text" ng-model="document.payment_terms_title" tabindex="22" />
                                                <div class="input-group-addon">
                                                    <input class="form-control form-control-sm" type="text" ng-model="document.payment_terms" tabindex="23" />
                                                </div>
                                            </div>

                                            <!-- Due Date -->
                                            <div class="input-group addon-input mt-1" ng-show="document.type === 'invoice'">
                                                <input class="input-label form-control form-control-sm" type="text" ng-model="document.due_date_title" tabindex="24" />
                                                <div class="input-group-addon">
                                                    <input class="form-control form-control-sm datepicker due-date" type="text" ng-model="document.due_date" tabindex="25" date-picker />
                                                </div>
                                            </div>

                                            <!-- PO # -->
                                            <div class="input-group addon-input mt-1" ng-hide="document.type == 'purchase_order'">
                                                <input class="input-label form-control form-control-sm" type="text" ng-model="document.purchase_order_title" tabindex="26" />
                                                <div class="input-group-addon">
                                                    <input class="form-control form-control-sm" type="text" ng-model="document.purchase_order" tabindex="27" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="items-holder">
                                    <div class="items-table-header rounded-1 bg-dark mb-1">
                                        <div class="amount">
                                            <div class="theme-label bordered">
                                                <input type="text" class="input-label form-control form-control-sm text-light" ng-model="document.amount_header" tabindex="31" />
                                            </div>
                                        </div>
                                        <div class="unit_cost">
                                            <div class="theme-label bordered">
                                                <input type="text" class="input-label form-control form-control-sm text-light" required ng-model="document.unit_cost_header" tabindex="30" />
                                            </div>
                                        </div>
                                        <div class="quantity">
                                            <div class="theme-label bordered">
                                                <input type="text" class="input-label form-control form-control-sm text-light" ng-model="document.quantity_header" tabindex="29" />
                                            </div>
                                        </div>
                                        <div class="name">
                                            <div class="theme-label bordered">
                                                <input type="text" class="input-label form-control form-control-sm text-light" ng-model="document.item_header" tabindex="28" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="items-table">
                                        <div class="item-row pb-1" ng-repeat="(k, item) in document.items">
                                            <div class="main-row">
                                                <div class="delete" ng-hide="document.items.length==1">
                                                    <button type="button" class="delete-row btn btn-link" ng-click="deleteLineItem(item)" tabindex="{{40+8*k+5}}">
                                                        <span class="fas fa-times"></span>
                                                    </button>
                                                </div>
                                                <div class="amount value" ng-bind-html="item.amount|currencyFormat:document.currency"></div>
                                                <div class="unit_cost">
                                                    <div ng-tabindex="40+8*k+3" ng-model="item.unit_cost" currency="document.currency" ng-required="true" input-amount></div>
                                                </div>
                                                <div class="quantity">
                                                    <input type="number" step="any" class="form-control form-control-sm" autocomplete="off" ng-model="item.quantity" tabindex="{{40+8*k+2}}" required />
                                                </div>
                                                <div class="name">
                                                    <textarea class="form-control form-control-sm" ng-model="item.name" tabindex="{{40+8*k+1}}" placeholder="{{translations['placeholders.item_description']}}" expanding-textarea></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="new-line">
                                        <button type="button" class="btn btn-outline-primary btn-sm" tabindex="1000" ng-click="addLineItem()">
                                            <span class="fas fa-plus"></span>
                                            {{translations['labels.line_item']}}
                                        </button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="invoice-footer">
                                            <div class="notes-holder">
                                                <div class="theme-label mb-1">
                                                    <input type="text" class="input-label form-control form-control-sm" ng-model="document.notes_title" tabindex="1014" />
                                                </div>
                                                <div class="value">
                                                    <textarea class="notes form-control form-control-sm" placeholder="{{translations['placeholders.notes']}}" ng-model="document.notes" tabindex="1015" expanding-textarea></textarea>
                                                </div>
                                            </div>
                                            <div class="terms-holder mt-3">
                                                <div class="theme-label mb-1">
                                                    <input type="text" class="input-label form-control form-control-sm" ng-model="document.terms_title" tabindex="1016" />
                                                </div>
                                                <div class="value">
                                                    <textarea class="terms form-control form-control-sm" placeholder="{{translations['placeholders.terms']}}" ng-model="document.terms" tabindex="1017" expanding-textarea></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Subtotal -->
                                        <div class="input-group addon-input">
                                            <input class="input-label form-control form-control-sm" type="text" ng-model="document.subtotal_title" tabindex="1001" />
                                            <div class="input-group-addon value deleteable" ng-bind-html="document.subtotal|currencyFormat:document.currency"></div>
                                        </div>

                                        <!-- Discounts -->
                                        <div class="input-group addon-input mt-1" ng-show="!!document.fields.discounts">
                                            <div class="delete">
                                                <button type="button" class="btn btn-link" ng-click="removeDiscount()">
                                                    <span class="fas fa-times"></span>
                                                </button>
                                            </div>
                                            <input class="input-label form-control form-control-sm" type="text" ng-model="document.discounts_title" tabindex="1002" />
                                            <div class="input-group-addon input deleteable">
                                                <div input-amount is-rate="discountIsRate" currency="document.currency" ng-model="document.discounts" ng-tabindex="1003" has-selector="true"></div>
                                            </div>
                                        </div>

                                        <!-- Tax -->
                                        <div class="input-group addon-input mt-1" ng-show="!!document.fields.tax">
                                            <div class="delete">
                                                <button type="button" class="btn btn-link" ng-click="removeTax()">
                                                    <span class="fas fa-times"></span>
                                                </button>
                                            </div>
                                            <input class="input-label form-control form-control-sm" type="text" ng-model="document.tax_title" tabindex="1004" />
                                            <div class="input-group-addon input deleteable">
                                                <div input-amount is-rate="taxIsRate" currency="document.currency" ng-model="document.tax" ng-tabindex="1005" has-selector="true"></div>
                                            </div>
                                        </div>

                                        <!-- Shipping -->
                                        <div class="input-group addon-input mt-1" ng-show="!!document.fields.shipping">
                                            <div class="delete">
                                                <button type="button" class="btn btn-link" ng-click="removeShipping()">
                                                    <span class="fas fa-times"></span>
                                                </button>
                                            </div>
                                            <input class="input-label form-control form-control-sm" type="text" ng-model="document.shipping_title" tabindex="1006" />
                                            <div class="input-group-addon input deleteable">
                                                <div input-amount is-rate="false" currency="document.currency" ng-model="document.shipping" ng-tabindex="1007"></div>
                                            </div>
                                        </div>

                                        <div class="add-rates mt-1">
                                            <button type="button" class="btn btn-link btn-sm" ng-click="addDiscount()" ng-hide="!!document.fields.discounts" tabindex="1008">
                                                <span class="fas fa-plus"></span>
                                                {{translations['labels.discount']}}
                                            </button>
                                            <button type="button" class="btn btn-link btn-sm" ng-click="addTax()" ng-hide="!!document.fields.tax" tabindex="1009">
                                                <span class="fas fa-plus"></span>
                                                {{translations['labels.tax']}}
                                            </button>
                                            <button type="button" class="btn btn-link btn-sm" ng-click="addShipping()" ng-hide="!!document.fields.shipping" tabindex="1010">
                                                <span class="fas fa-plus"></span>
                                                {{translations['labels.shipping']}}
                                            </button>
                                        </div>

                                        <!-- Total -->
                                        <div class="input-group addon-input mt-1">
                                            <input class="input-label form-control form-control-sm" type="text" ng-model="document.total_title" tabindex="1011" />
                                            <div class="input-group-addon value deleteable" ng-bind-html="document.total|currencyFormat:document.currency"></div>
                                        </div>

                                        <!-- Amount Paid -->
                                        <div class="input-group addon-input mt-1" ng-show="document.type === 'invoice'">
                                            <input class="input-label form-control form-control-sm" type="text" ng-model="document.amount_paid_title" tabindex="1012" />
                                            <div class="input-group-addon input deleteable">
                                                <div input-amount currency="document.currency" ng-model="document.amount_paid" ng-tabindex="1013"></div>
                                            </div>
                                        </div>

                                        <!-- Amount Refunded -->
                                        <div class="input-group addon-input mt-1" ng-show="document.type === 'credit_note'">
                                            <input class="input-label form-control form-control-sm" type="text" ng-model="document.amount_paid_title" tabindex="1012" />
                                            <div class="input-group-addon input deleteable">
                                                <div input-amount currency="document.currency" ng-model="document.amount_refunded" ng-tabindex="1013"></div>
                                            </div>
                                        </div>

                                        <!-- Balance -->
                                        <div class="input-group addon-input mt-1" ng-show="document.type === 'invoice'">
                                            <input class="input-label form-control form-control-sm" type="text" ng-model="document.balance_title" tabindex="1014" />
                                            <div class="input-group-addon value deleteable" ng-bind-html="document.balance|currencyFormat:document.currency"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="invoice-controls mobile">
                            <div class="d-none d-md-flex justify-content-between">
                                <button type="button" class="btn btn-primary w-50 m-2" ng-disabled="documentForm.$invalid" ng-click="saveAndDownloadPDF()">
                                    <span ng-show="cloudMode"><span ng-show="isExisting">{{translations['labels.save']}}</span><span ng-hide="isExisting">{{translations['labels.create']}}</span></span>
                                    <span ng-hide="cloudMode"><span class="fas fa-arrow-to-bottom"></span> {{translations['labels.download']}}</span>
                                </button>
                            </div>

                            <div class="mt-3">
                                <label class="control-label">{{translations['labels.currency']}}</label>
                                <div>
                                    <select class="form-select form-select-sm" ng-model="document.currency" ng-options="currency.code as currency.name for (code, currency) in currencies"></select>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="" ng-click="saveDefaults()" ng-show="!isDefault()" class="btn btn-link">
                                    {{translations['labels.save_default']}}
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

        </div>
    </div> --}}
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
    $(document).ready(function(){
        $('body').on('click', '.deleteBtn', function () {
        var val = $(this).attr('href');
        $('#deleteModalForm').attr('action', val);

        });
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>
    <!-- Datatable -->

@endsection
