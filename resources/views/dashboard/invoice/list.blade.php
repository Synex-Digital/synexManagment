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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $data )
                            <tr>
                                <td class="text-dark">{{ $loop->iteration }}</td>
                                <td class="text-dark">{{ $data->invoice_number }}</td>
                                @if($data->client_id)
                                <td>
                                    <a  class="text-dark " style="text-decoration: underline" href="{{ route('client.show', $data->client_id) }}"  title="Profile" > {{ $data->client->name }}</a>
                                </td>
                                @else
                                <td class="text-dark">{{  $data->bill_to_value }}</td>
                                @endif
                                <td class="text-dark">{{ ($data->currency == 'USD' ? '$' : '৳').$data->subtotal_value }}</td>
                                <td class="text-dark">{{ ($data->discount_type == '%' ? $data->discount_value.'%' : ($data->currency == 'USD' ?$data->discount_value.'$' :$data->discount_value. '৳')) }}</td>
                                <td class="text-dark">{{ $data->tax_value.'%' }}</td>
                                <td class="text-dark">{{  ($data->currency == 'USD' ? '$' : '৳').$data->total_value }}</td>
                                <td class="text-dark">  <span class="badge badge-pill badge-{{ $data->status == 0 ? 'warning' : 'success' }}">{{ $data->status == 0 ? 'Pending' : 'Paid' }}</span>

                                </td>
                                <td>
                                    <a href="{{ route('invoice.edit', $data->id) }}"  title="Edit" class="{{ $data->status == 1 ? 'disabled' : '' }} btn btn-outline-primary btn-sm mr-1  " style="font-size: 11px !important;"><i class="fa fa-pencil"></i> </a>
                                    <button  {{ $data->status == 1 ? 'disabled' : '' }}
                                         data-invoice="{{ $data->id }}" data-client= "{{ $data->client }}" data-toggle="modal" data-target="#mailModal"   title="Mail"
                                         class="mailBtn btn btn-outline-{{ $data->sent_status == 0 ? 'warning' : 'success' }} btn-sm mr-1  "
                                         style="font-size: 11px !important;">
                                         <i class="fa fa-{{ $data->sent_status == 0 ? 'send' : 'check' }}"></i>
                                    </button>

                                    <div class="dropdown custom-dropdown">
                                        <div data-toggle="dropdown">
                                            <a href="" class="btn"><i class="fa fa-ellipsis-v"></i></a>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right" style="min-width: 113px;">
                                            {{-- <a class="dropdown-item border-bottom py-1" href="#">Edit</a> --}}
                                            <a href="{{ route('invoice.download', $data->id) }}" type="button" class="editBtn dropdown-item py-1" >Download</a>
                                            <button  data-target="#statusModal" data-toggle="modal"  data-value="{{ $data->id }}" type="submit" class="  {{ $data->status == 1 ? 'disabled' : '' }} statusBtn dropdown-item py-1" >Status</button>


                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr> <td colspan="8" class="text-center">NO DATA FOUND</td>  </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

 <!--categroy Modal -->
 <div class="modal fade" id="statusModal" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('invoice.status_update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="" class="form-label font-weight-bold"> Status</label>
                            </div>
                            <div class="col-lg-6">
                                <div class="radio">
                                    <label>
                                        <input type="radio" checked name="optradio" value="unpaid"> Unpaid</label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optradio" value="paid"> Paid</label>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" name="invoice_id" class="invoice_id">
                    </div>
                    <div class="modal-footer">
                        <button id="categoryCreateBtn" type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Update</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>
 <!--categroy Modal -->
 <div class="modal fade" id="mailModal" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mail Address</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('invoice.mail') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input id="client_email" name="client_email" type="email" class="form-control" placeholder="Enter Email" required>
                        <input type="hidden" name="invoice_id" id="invoice_id">
                    </div>
                    <div class="modal-footer">
                        <button id="categoryCreateBtn" type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Send</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>



@endsection
@section('script')
<script src="{{asset('dashboard_assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/plugins-init/datatables.init.js')}}"></script>



<script>
    $('.mailBtn').on('click', function(){
        var client = $(this).data('client');
        let invoice = $(this).data('invoice');
        $('#invoice_id').val(invoice);
        if(client.email){
            $('#client_email').val(client.email);

        }else{
            $('#client_email').val('');
        }
    });
    $('.statusBtn').on('click', function(){
        var data = $(this).data('value');
        $('.invoice_id').val(data);

    });
</script>
@endsection
