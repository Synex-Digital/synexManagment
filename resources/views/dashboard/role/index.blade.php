@extends('dashboard.layouts.app')
@section('style')
<link rel="stylesheet" href="{{asset('dashboard_assets/vendor/select2/css/select2.min.css')}}">
@endsection
@section('content')
<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Role Management</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item " >Role Management</li>
            {{-- <li class="breadcrumb-item"> <a class="text-primary"> Client Details</a> </li> --}}
        </ol>
    </div>

</div>
<div class="row ">
    <div class="col-lg-4">
       @if (Auth::user()->can('role.create'))
       <div class="card">
        <div class="card-header">
            <h4>Create Role</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Role Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required value="{{ old('name') }}" >
                    @error('name')<span class="text text-sm text-danger">{{ $message }}</span >  @enderror


                </div>
                <div class="form-group">
                    <label for="name">Permissions</label>
                    <br>
                    @if('error')<span class="text text-sm text-danger">{{ session('error') }}</span >  @endif

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">
                        <label class="form-check-label" for="checkPermissionAll">All</label>
                    </div>
                    <hr>
                    @php $i = 1; @endphp
                    @foreach ($permission_groups as $group)
                        <div class="row">
                            <div class="col-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                    <label class="form-check-label" for="   ">{{ $group->name }}</label>
                                </div>
                            </div>

                            <div class="col-9 role-{{ $i }}-management-checkbox">
                                @php
                                    $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                    $j = 1;
                                @endphp
                                @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                        <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                    @php  $j++; @endphp
                                @endforeach
                                <br>
                            </div>

                        </div>
                        @php  $i++; @endphp
                    @endforeach



                </div>
                <div class="mb-3 ">
                   <button class=" float-right btn btn-outline-primary " style="font-size: 11px !important;">Create</button>
                </div>
            </form>
        </div>
    </div>
       @endif
    </div>
    <div class="col-lg-8">
       @if (Auth::user()->can('role.assign'))
       <div class="card">
        <div class="card-header">
            <h4>Assign Role</h4>
            @if (Auth::user()->can('user.create'))
            <a href="{{ route('employee.index') }}" class=" btn btn-outline-primary " style="font-size: 11px !important;">Add Employee </a>
            @endif
        </div>
        <div class="card-body">
            <form action="{{route('roleAssign.store')}}" method="post">
                @csrf
                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <select name="user_id" class="single-select" id="">
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group col-md-6">
                        <select name="role_id" class="single-select" id="">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class=" float-right btn btn-outline-primary " style="font-size: 11px !important;">Assign</button>
                </div>
            </form>
        </div>
    </div>
       @endif
        <div class="card mb-4">
            <div class="card-header">
                <h4> User Has Roles  </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)

                            <tr>
                                <td><strong>{{ $key+1 }}</strong></td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @forelse ($user->getRoleNames() as $permission)
                                   <span class="badge badge-primary text-white mr-1">{{ $permission }}</span>
                                    @empty
                                    Member
                                    @endforelse
                                </td>

                                    @if ($key != 0)
                                        @if (Auth::user()->can('roleUser.delete'))
                                        <td><a class="btn btn-sm btn-danger" href="{{ route('userRole.delete',$user->id) }}"> <i class="fa fa-trash "></i></a></td>
                                        @endif
                                        @else
                                     <td>   <span class="btn btn-dark btn-sm text-white"> <i class="fa fa-trash "></i></span></td>
                                    @endif




                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 >Role Has Permissions</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $perm)
                                        <span class="badge badge-dark text-white mr-1">
                                            {{ $perm->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>

                                    @if (Auth::user()->can('rolePermission.delete'))
                                        @if ($key != 0)
                                            <a class="btn btn-sm btn-danger text-white" href="{{ route('role.destroy', $role->id) }}"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">
                                                <i class="fa fa-trash "></i>
                                            </a>

                                            <form id="delete-form-{{ $role->id }}" action="{{ route('role.destroy', $role->id) }}" method="POST" style="display: none;">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                            @else
                                            <span class="btn btn-dark btn-sm text-dark"> <i class="fa fa-trash "></i></span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>





@endsection
@section('script')
<script>
    $(document).ready(function() {

        $('.hamburger').trigger('click');
    });
</script>
<script>

    /**
         * Check all the permissions
         */
         $("#checkPermissionAll").click(function(){

             if($(this).is(':checked')){
                 // check all the checkbox
                 $('input[type=checkbox]').prop('checked', true);
             }else{
                 // un check all the checkbox
                 $('input[type=checkbox]').prop('checked', false);
             }
         });

         function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');

            if(groupIdName.is(':checked')){
                 classCheckBox.prop('checked', true);
             }else{
                 classCheckBox.prop('checked', false);
             }
            implementAllChecked();
         }

         function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            const classCheckbox = $('.'+groupClassName+ ' input');
            const groupIDCheckBox = $("#"+groupID);

            // if there is any occurance where something is not selected then make selected = false
            if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
                groupIDCheckBox.prop('checked', true);
            }else{
                groupIDCheckBox.prop('checked', false);
            }
            implementAllChecked();
         }

         function implementAllChecked() {
             const countPermissions = {{ count($all_permissions) }};
             const countPermissionGroups = {{ count($permission_groups) }};

            //  console.log((countPermissions + countPermissionGroups));
            //  console.log($('input[type="checkbox"]:checked').length);

             if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)){
                $("#checkPermissionAll").prop('checked', true);
            }else{
                $("#checkPermissionAll").prop('checked', false);
            }
         }


</script>
<script src="{{asset('dashboard_assets/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/plugins-init/select2-init.js')}}"></script>
@endsection
