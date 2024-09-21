@extends('dashboard.layouts.app')
@section('style')


<link href="{{asset('dashboard_assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">

@endsection
@section('content')

<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="">Invoice</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('invoice.generate') }}" class="">Invoice</a></li>
            <li class="breadcrumb-item " ><a class="text-primary"> List</a></li>
        </ol>
    </div>

</div>
<div class="row">
    <div class="col-lg-12">
        <a href="{{ route('invoice.generate') }}" class="btn btn-rounded btn-primary mr-3 text-white" >
        <span class="btn-icon-left text-primary mr-2" style="    margin: -4px 0px -4px -10px;"  >  <i class="fa fa-plus color-info"style="    margin: 2px -3px 1px -3px;" ></i> </span>Generate</a>
    </div>
</div>


<div class="row mt-5">
    <div class="col-lg-12 ">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title pb-3">Invoice List</h4>
                {{-- <button data-target="#mergeModal" data-toggle="modal" type="button" id="add" class=" btn btn-outline-primary " style="font-size: 11px !important;">Merge</button> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice No</th>
                                <th>Bill To</th>
                                <th>Subtotal</th>
                                <th>Discount</th>
                                <th>Tax</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $data )
                            <tr>
                                <td class="text-dark">{{ $loop->iteration }}</td>
                                <td class="text-dark">{{ $data->invoice_number }}</td>
                                <td class="text-dark">{{ $data->bill_to_value }}</td>
                                <td class="text-dark">{{ ($data->currency == 'USD' ? '$' : '৳').$data->subtotal_value }}</td>
                                <td class="text-dark">{{ ($data->discount_type == '%' ? $data->discount_value.'%' : ($data->currency == 'USD' ?$data->discount_value.'$' :$data->discount_value. '৳')) }}</td>
                                <td class="text-dark">{{ $data->tax_value.'%' }}</td>
                                <td class="text-dark">{{  ($data->currency == 'USD' ? '$' : '৳').$data->total_value }}</td>
                                <td>
                                    <a href="{{ route('invoice.edit', $data->id) }}"  title="Edit" class=" btn btn-outline-primary btn-sm mr-1  " style="font-size: 11px !important;"> Edit</a>
                                </td>

                            </tr>
                            @empty
                            <tr> <td colspan="5" class="text-center">NO DATA FOUND</td>  </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection
@section('script')
<script src="{{asset('dashboard_assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/plugins-init/datatables.init.js')}}"></script>
@endsection
