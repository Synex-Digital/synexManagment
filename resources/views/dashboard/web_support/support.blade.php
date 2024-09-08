@extends('dashboard.layouts.app')

@section('style')
<link href="{{asset('dashboard_assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')


<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Web Support</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item " ><a href="{{route('web.customer')}}" class="">Customer</a></li>
            <li class="breadcrumb-item " ><a class="text-primary">Web Support</a></li>
        </ol>
    </div>

</div>
<div class="row mb-5">
    <div class="col-lg-12 ">
        <div class="card">
            <div class="card-header">
                <p class="card-text text-dark"><span class="font-weight-bold">Name :</span> {{$customer->name}}</p>
                <p class="card-text {{$customer->email ? 'text-dark' : 'text-danger'}}"><span class="text-dark font-weight-bold">Email :</span> {{$customer->email ?? 'NULL'}}</p>
                <p class="card-text {{$customer->number ? 'text-dark' : 'text-danger'}}"><span class=" text-dark font-weight-bold">Phone :</span>{{$customer->number? '+'.$customer->number: 'NULL'}}</p>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title pb-3">Support List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Time</th>
                                <th>Category</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($supports as $data )
                            <tr>
                                <td class="text-dark">{{$loop->iteration}}</td>
                                <td class="text-dark">
                                    <span >
                                        {{$data->created_at->format('D-m-y')}}
                                    </span>

                                    <span class="badge badge-light text-primary"> {{$data->created_at->diffForHumans()}}</span>
                                   </td>
                                <td class="text-dark">{{$data->category}}</td>
                                <td>

                                    <textarea class="form-control" name="description" id="" cols="30" rows="4">{{$data->description}}</textarea>
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
@endsection
