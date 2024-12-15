@extends('dashboard.layouts.app')

@section('style')
<link href="{{asset('dashboard_assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('dashboard_assets/vendor/select2/css/select2.min.css')}}">
@endsection
@section('content')


<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Web Support</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item " ><a class="text-primary">Web Support</a></li>
        </ol>
    </div>

</div>
<div class="row mb-5">
    <div class="col-lg-12 ">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title pb-3">Cusomer List</h4>
                <button data-target="#mergeModal" data-toggle="modal" type="button" id="add" class=" btn btn-outline-primary " style="font-size: 11px !important;">Merge</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-striped" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($customers as $data )
                            <tr>
                                <td class="text-dark">{{$data->name}}</td>
                                <td class="{{$data->email ? 'text-dark' : 'text-danger'}}">{{$data->email ?? 'NULL'}}</td>
                                <td class="{{$data->number ? 'text-dark' : 'text-danger'}}">{{$data->number ?'+'.$data->number: 'NULL'}}</td>
                                <td>
                                    <a href="{{route('web.support',$data->id) }}" title="view" class=" btn btn-outline-info btn-sm mr-1  "> <i class="fa fa-eye"></i></a>
                                    <a
                                    data-value="{{$data}}"
                                    title="edti" class="editBtn btn btn-outline-primary btn-sm mr-1  "> <i class="fa fa-pencil"></i></a>
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

 <!--merge Modal -->
 <div class="modal fade" id="mergeModal" >
    <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Merge Customer Info</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('web.customer.merge') }}" method="POST" >
                    @csrf
                    <div class="row">
                        <div class=" col-md-6">
                            <label class=" form-label">Customer Email</label>
                            <select name="customer_email"  class="single-select" required >
                                <option value="">SELECT EMAIL</option>
                                @forelse ($customers as $data )
                                @if($data->email != null && $data->number == null)
                                <option value="{{$data->id}}"> {{$data->email}}</option>
                                @endif
                                @empty
                                <option disabled> No Data</option>
                                @endforelse

                            </select>


                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="" class="form-label">Customer Number</label>
                            <select name="customer_number" id="number" class="single-select" required >
                                <option value="">SELECT NUMBER</option>
                                @forelse ($customers as $data)
                                    @if($data->number != null && $data->email == null)
                                        <option value="{{$data->id}}"> {{$data->number}}</option>
                                    @endif
                                @empty
                                <option disabled> No Data</option>
                                @endforelse

                            </select>

                        </div>
                    </div>

                    <p class="float-left mt-3">NOTE: Customer email will be the primary identity</p>
                    <div class="modal-footer">
                        <button id="categoryCreateBtn" type="submit" class="btn  btn-outline-primary " style="font-size: 11px;">Merge</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
 <!--edit data Modal -->
 <div class="modal fade" id="editModal" >
    <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Customer Info</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('web.customer.update') }}" method="POST" >
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="customer_id" id="customer_id" >
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div id="editEmailDiv">

                    </div>
                    <div id="editNumberDiv">

                    </div>
                    <div class="modal-footer">
                        <button id="" type="submit" class="btn  btn-outline-primary " style="font-size: 11px;">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
        // delete
        $('body').on('click', '.deleteBtn', function () {
            var val = $(this).attr('href');
            $('#deleteModalForm').attr('action', val);
        });

        $('.editBtn').on('click', function () {
            let val = $(this).data('value');
            $('#name').val(val.name);
            $('#customer_id').val(val.id);
            if(val.email){
                $('#editEmailDiv').html(' <div class="mb-3"> <label for="" class="form-label">Email</label> <input type="email" name="email" value="'+val.email+'"  class="form-control" required> </div>');
            }else{
                $('#editEmailDiv').html('');
            }
            if(val.number){
                $('#editNumberDiv').html('<div class="mb-3"> <label for="" class="form-label">Phone</label>  <input type="number" name="phone" value="'+val.number+'" class="form-control" required> </div>')
            }else{
                $('#editNumberDiv').html('');
            }
            $('#editModal').modal('show');
        });

</script>

    <!-- Datatable -->
    <script src="{{asset('dashboard_assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/plugins-init/datatables.init.js')}}"></script>
    <script src="{{asset('dashboard_assets/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/plugins-init/select2-init.js')}}"></script>
@endsection
