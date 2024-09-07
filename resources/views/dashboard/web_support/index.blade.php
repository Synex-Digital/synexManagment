@extends('dashboard.layouts.app')

@section('style')

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
                <h4 class="card-title pb-3">Web Support List</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        @forelse ($customers as $data )
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 ">
                        <div class="">
                            <p class="card-text text-dark"><span class="font-weight-bold">Name :</span> {{$data->customer->name}}</p>
                            <p class="card-text text-dark"><span class="font-weight-bold">Email :</span> {{$data->customer->email}}</p>
                            <p class="card-text text-dark"><span class="font-weight-bold">Phone :</span>{{$data->customer->number}}</p>
                            <p class="card-text text-dark"><span class="font-weight-bold">Category :</span>{{$data->category}}</p>

                            {{-- <a href="{{route('web_support.destroy', $data->id)}}" class="btn btn-danger deleteBtn">Delete</a> --}}
                        </div>
                    </div>
                    <div class="col-lg-9 mt-3">
                        <p class="card-text text-dark">{{$data->description}}</p>
                    </div>
                </div>
                <p class="card-text text-dark float-right">{{ $data->created_at->diffForHumans()}}</p>
            </div>
        </div>
        @empty

        @endforelse
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
