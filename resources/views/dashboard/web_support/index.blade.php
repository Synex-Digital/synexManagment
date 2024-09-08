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
                <button data-target="#mergeModal" data-toggle="modal" type="button" id="add" class=" btn btn-primary " style="font-size: 12px !important;">Merge</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
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
                                    <a href="{{route('web.support',$data->id) }}" title="view" class=" btn btn-outline-primary btn-sm mr-1  "> <i class="fa fa-eye"></i></a>
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
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class=" col-md-6">
                            <label class=" form-label">Customer Email</label>
                            <select name="customer_email" id="email" class="single-select" required >
                                <option value="">SELECT EMAIL</option>
                                @forelse ($customers as $data )
                                @if($data->email != null)
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
                                @forelse ($customers as $data )
                                    @if($data->number != null)
                                        <option value="{{$data->id}}"> {{$data->number}}</option>
                                    @endif
                                @empty
                                <option disabled> No Data</option>
                                @endforelse

                            </select>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button id="categoryCreateBtn" type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Merge</button>
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
</script>

    <!-- Datatable -->
    <script src="{{asset('dashboard_assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/plugins-init/datatables.init.js')}}"></script>
    <script src="{{asset('dashboard_assets/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/plugins-init/select2-init.js')}}"></script>
@endsection
