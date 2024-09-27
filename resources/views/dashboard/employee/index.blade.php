@extends('dashboard.layouts.app')
@php
    $user = Auth::user();
@endphp
@section('style')
<link rel="stylesheet" href="{{asset('dashboard_assets/vendor/select2/css/select2.min.css')}}">
<style>
    @media (max-width: 576px) {
        #add{
            width: 96%;
        }
        .src{
            width: 100%;
        }
    }
</style>

@endsection
@section('content')

<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Employees</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            {{-- <li class="breadcrumb-item">Employee</li> --}}
            <li class="breadcrumb-item " ><a class="text-primary"> Employee</a></li>
        </ol>
    </div>

</div>
    <div class="row mb-5">
        <div class="col-lg-12 mb-3">
            <div class=" mb-4 bg-white rounded shadow-sm " style="padding-top:14px; padding-left: 16px; padding-bottom: 3px;">
                <form action="{{route('searchEmployee')}}" method="GET" >
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 mb-2">
                        @if ($user->can('employee.create'))
                        <button type="button" id="add" class=" btn btn-outline-primary " data-toggle="modal" data-target="#createModal" style="font-size: 11px !important;">Add Employee</button>
                        @endif

                      </div>

                        <div class="col-lg-8 col-md-8 col-sm-8 float-right d-flex justify-content-end align-items-center">
                            <div class=" mb-2 mr-3 src">
                                <input type="search" name="name" class="form-control " placeholder="Employee Name" >
                            </div>

                            <div class=" mb-2 text-center mr-3">
                            <button type="submit" class="btn btn-primary   float-right" style="font-size: 11px;">Search</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    @foreach ($users as $data )
      @if ($data->employees)
      <div class="col-md-3 mb-4">
        <div class="card position-relative">
            <a href="{{ route('employee.show', $data->id) }}">
                @if ( $data->employees->image == null)
                <img src="https://ui-avatars.com/api/?name={{$data->name}}&background=random" class="card-img-top rounded-circle mx-auto d-block" alt="" style="max-width: 150px; margin-top: 20px;">
                @else
                <img src="{{ asset('uploads/employee') }}/{{ $data->employees->image }}" class="card-img-top rounded-circle mx-auto d-block" alt="John Doe" style="max-width: 150px; margin-top: 20px;">
                @endif
                <div class="card-body text-center">
                    <h5 class="card-title">{{$data->name}} </h5>
                    <p class="card-text text-muted">{{$data->employees->designations? $data->employees->designations->designation : 'UNKNOWN'}}</p>
                </div>
            </a>
          <div class=" position-absolute top-0 end-0  me-3" style="right:0;">
            @if ($user->can('employee.delete'))
            <div class="dropdown custom-dropdown">
                <div data-toggle="dropdown">
                    <a href="" class="btn"><i class="fa fa-ellipsis-v"></i></a>
                </div>
                <div class="dropdown-menu dropdown-menu-right" style="min-width: 113px;">
                    {{-- <a class="dropdown-item border-bottom py-1" href="#">Edit</a> --}}
                    <button  data-value="{{$data}}" data-employee="{{ $data->employees }}" type="button" class="editBtn dropdown-item py-1" >Edit</button>
                    <form id="desigDeleteForm" action="{{route('employee.destroy',$data->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item py-1" >Delete</button>
                    </form>

                </div>
            </div>
            @endif
          </div>
        </div>
    </div>
      @endif
    @endforeach


    </div>


 <!--create  Modal -->
 <div class="modal fade" id="createModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employee Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('employee.store')}}" method="POST">
                    @csrf
                    <div class="form-row mb-3">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label font-weight-bold">Full Name :</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter  Full Name" required value="{{old('name')}}" >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword4" class="font-weight-bold">Email :</label>
                          <input type="email" name="email" class="form-control"  placeholder="Enter Email" required value="{{old('email')}}">
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label font-weight-bold">Phone :</label>
                            <input type="number" name="phone" class="form-control" placeholder="Enter Contact Number" required value="{{old('phone')}}">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword4" class="font-weight-bold">Start Date :</label>
                          <input type="date" name="start_date" class="form-control" id="inputPassword4" placeholder="Enter Email" required value="{{old('start_date')}}">
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label font-weight-bold">Department :</label>

                            <select name="department" id="department" class="single-select" required >
                                <option value="">SELECT DEPARTMENT</option>
                                @foreach ($departments as $data )
                                    <option value="{{$data->id}}">{{$data->department}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4" class="font-weight-bold">Designation : </label>
                            <a href="{{ route('department.index') }}" class="btn btn-outline-primary float-right" style="height:18px; width:30px;"><i class="fa fa-plus" style="top: -9px; left: -2px; position: relative; font-size:10px;"></i></a>

                            <select name="designation" id="designation" class="single-select" required >
                                <option value="">Designation</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label font-weight-bold">Password :</label>
                            <input type="text" name="password" class="form-control" placeholder="Enter Password" required  value="{{old('password')}}">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword4" class="font-weight-bold">Confirm Password :</label>
                          <input type="password" name="password_confirmation" class="form-control" id="inputPassword4" placeholder="Confirm  Password"  required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn  btn-outline-primary float-right" style="font-size: 11px;">Add Employee</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
 <!-- Edit Modal -->
 <div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm"  method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row mb-3">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label font-weight-bold">Full Name :</label>
                            <input id="name" type="text" name="name" class="form-control" placeholder="Enter  Full Name" required  >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword4" class="font-weight-bold">Email :</label>
                          <input id="email" type="email" name="email" class="form-control"  placeholder="Enter Email" required >
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label font-weight-bold">Phone :</label>
                            <input id="phone" type="number" name="phone" class="form-control" placeholder="Enter Contact Number" required >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword4" class="font-weight-bold">Start Date :</label>
                          <input id="start_date" type="date" name="start_date" class="form-control" id="inputPassword4" placeholder="Enter Email" required >
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label font-weight-bold">Department :</label>

                            <select name="department" id="department2" class="form-control" required >
                                <option value="" >SELECT DEPARTMENT</option>
                                @foreach ($departments as $data )
                                <option  value="{{$data->id}}">{{$data->department}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4" class="font-weight-bold">Designation : </label>
                            <a href="{{ route('department.index') }}" class="btn btn-outline-primary float-right" style="height:18px; width:30px;"><i class="fa fa-plus" style="top: -9px; left: -2px; position: relative; font-size:10px;"></i></a>

                            <select name="designation" id="designation2" class="single-select" required >
                                <option value="">Designation</option>

                            </select>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button class="btn  btn-outline-primary float-right" style="font-size: 11px;">Update </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function(){
        //edit data show
        $('.editBtn').on('click',function(){
            let data = $(this).data('value');
            let employee = $(this).data('employee');
            let route = `{{route('employee.update',':id')}}`;
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#phone').val(employee.phone);
            $('#start_date').val(employee.start_date);
            $('#department2 option').each(function(){
                if($(this).val() == employee.department_id)
                    $(this).attr('selected','selected');
            });

            $('#editForm').attr('action',route.replace(':id',data.id));
            $('#editModal').modal('show');

        });

        $('#department2').change(function(){
            var departmentId = $(this).val();
            if(departmentId){
                $.ajax({
                    type:"GET",
                    url:"/get-designations/"+departmentId,
                    success:function(res){
                        if(res){
                            $("#designation2").empty();
                            $.each(res,function(key,value){
                                $("#designation2").append('<option value="'+value.id+'">'+value.designation+'</option>');
                            });
                        }else{
                            $("#designation2").empty();
                        }
                    }
                });
            }else{
                $("#designation2").empty();
            }
        });
        $('#department').change(function(){
            var departmentId = $(this).val();
            if(departmentId){
                $.ajax({
                    type:"GET",
                    url:"/get-designations/"+departmentId,
                    success:function(res){
                        if(res){
                            $("#designation").empty();
                            $.each(res,function(key,value){
                                $("#designation").append('<option value="'+value.id+'">'+value.designation+'</option>');
                            });
                        }else{
                            $("#designation").empty();
                        }
                    }
                });
            }else{
                $("#designation").empty();
            }
        });
    });
</script>
<script src="{{asset('dashboard_assets/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/plugins-init/select2-init.js')}}"></script>
@endsection
