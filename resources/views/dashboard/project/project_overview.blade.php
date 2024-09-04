@extends('dashboard.layouts.app')
@php
        function startDate($date){
        // Assuming $data->dateRange contains the date string "05/21/2024 - 05/22/2024"
        $dateRange = $date;
        // Explode the date string into an array
        $dates = explode(" - ", $dateRange);
        // Convert the dates into the desired format
        $start_date = DateTime::createFromFormat('m/d/Y', $dates[0])->format('d-M-y');

        return $start_date ;

    }
        function endDate($date){
        // Assuming $data->dateRange contains the date string "05/21/2024 - 05/22/2024"
        $dateRange = $date;
        // Explode the date string into an array
        $dates = explode(" - ", $dateRange);
        // Convert the dates into the desired format

        $end_date = DateTime::createFromFormat('m/d/Y', $dates[1])->format('d-M-y');
        return  $end_date;

    }
@endphp
@section('style')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<link rel="stylesheet" href="{{asset('dashboard_assets/vendor/select2/css/select2.min.css')}}">
<style>
    .btn-outline-primary{
       background-color: #e3daff !important;
        border: 0 !important;
        font-size: 15px;
    }
    .btn-outline-primary:hover{
       background-color: #6b51df !important;
    }
    @media (max-width: 576px) {
        .between{
            justify-content: space-between !important;
        }
    }
    @media (min-width: 577px) and (max-width: 768px) {
        .between{
            justify-content: space-between !important;
        }
    }
    @media (min-width: 767px) {
        .between{
            justify-content: space-around !important;
        }
    }


    .file-upload {
        position: relative;
        display: inline-block;
    }

    .file-upload input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer !important;
    }
    .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* semi-transparent black */
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-spinner {
            border: 2px solid #f3f3f3; /* Light grey */
            border-top: 2px solid #6f00ff; /* Blue */
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .hover:hover .icon {
            display: inline !important;
        }

</style>

@endsection
@section('content')
@if (!Auth::user()->employees)
<div class="row">
    <div class="col-lg-6">
        <h3 class="display-5"> Project Overview</h3>
    </div>
    <div class="col-lg-6">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('project.index')}}">Projects</a></li>
            <li class="breadcrumb-item " ><a class="text-primary"> Project Overview</a></li>
        </ol>
    </div>

</div>
    <div class="row mb-5">
        <div class="col-lg-9 mb-5">
            <div class="card ">
                <div class="card-header ">
                   <h6 class="font-weight-bold mb-0" > <span style="border-left: 4px solid #593bdb"> </span> &nbsp; Project Details</h6>
                   @if (Auth::user()->can('project.create'))

                   <a href="{{ route('project.create') }}" class=" btn btn-outline-primary  " style="font-size: 11px !important;">Create Project</a>
                   @endif

                </div>
                <div class=" mt-2 border-bottom"></div>
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex ml-3">
                            <i class="fa fa-circle text-info  m-auto " style="font-size:9px;"></i>
                            <h4 class="ml-2 mb-0">{{$project->name}}</h4>
                        </div>
                    </div>
                    <div class="row mt-4  ml-1">
                        <h6 class="" style="margin-top: 2px; margin-right: 3px">Client : </h6>
                        @if($project->client_id == 0)
                        <span style="position: relative; top: -2.5px">N/A</span>
                        @else
                        <a href="{{route('client.show',$project->client_id)}}" class="" style="margin-bottom: 0.5rem;"> {{ $project->client? $project->client->name : 'N/A' }}</a>
                        @endif
                    </div>
                    <div class="row   ml-1">
                        <h6 class="" style=" margin-right: 3px">Budget :</h6> <span style="position: relative; top: -2.5px">৳{{ $project->budget }}</span>
                    </div>
                    <div class="row mt-1 ml-1">
                        <h6 class="">Project Description:</h6>
                    </div>
                    <p class="ml-1">

                        {!!$project->description!!}
                    </p>
                    <hr>

                    <div class="row">

                            <div class=" between col-lg-4 col-md-4 col-sm-4 d-flex ">
                                <div class="d-inline-block  ">
                                    <p class="mb-0">Leader</p>
                                    <h6>
                                        @if ($project->leader)
                                        <a class="" href="{{route('employee.show',$project->leader_id)}}" >{{$project->leader->name}}</a>
                                        @else
                                        {{ 'UNASSIGNED' }}
                                        @endif

                                    </h6>
                                </div>
                                <div class="float-right ">
                                    <p class="mb-0">Start Date</p>
                                <h6 class="">{{startDate($project->dateRange)}}</h6>
                                </div>
                            </div>
                            <div class=" between col-lg-4 col-md-4 col-sm-4 d-flex ">
                                <div class="d-inline-block ">
                                    <p class="mb-0">End Date</p>
                                    <h6>{{endDate($project->dateRange)}}</h6>
                                </div>
                                <div class="float-right ">
                                    <p class="mb-0">Members</p>
                                <h6 class="ml-4">
                                    @if ($memberCount == 0)
                                        {{ 'N/A' }}
                                    @else

                                    {{$memberCount >= 5 ? '5+' : $memberCount}}
                                    @endif
                                </h6>
                                </div>
                            </div>
                            <div class=" between col-lg-4  col-md-4 col-sm-4 d-flex ">
                                <div class="d-inline-block ">
                                    <p class="mb-0">Status</p>
                                    <p class="badge badge-light text-warning"> {{$project->status}} </p>
                                </div>
                                <div class="float-right ">
                                    <p class="mb-0">Priority</p>
                                    <p class="badge badge-light text-info"> {{$project->priority}} </p>
                                </div>
                            </div>

                    </div>

                </div>
            </div>

        </div>
        <div class="col-lg-3">
            <div class="card ">
                <div class="card-header ">
                   <h6 class="font-weight-bold" > <span style="border-left: 4px solid #593bdb"> </span> &nbsp; Project Task</h6>
                   @if (Auth::user()->can('project.task.add'))
                   <button type="button" id="add" class=" btn btn-primary " data-toggle="modal" data-target="#createTask" style="font-size: -2px !important;height: 23px;width: 39px;">
                    <i class="fa fa-plus text-white" style="top: -5px; position: relative;"></i>
                </button>
                @endif


                </div>
                <div class=" mt-2 border-bottom"></div>
                <div class="">
                    @if ($project->tasks->count() == 0)
                    <div class="text-center  py-2 px-3 border-bottom">
                        <p class="   pb-0 mb-0">EMPTY</p>
                    </div>
                    @endif

                   @foreach ($project->tasks as $data )

                   <div class=" hover d-flex justify-content-between  pt-3 px-3 border-bottom">
                       {{-- <p class="text-dark copyable" data-title="{{ $data->title }}">{{ substr($data->title,0,20) .'...' }}</p> --}}
                       <p class="text-dark fullText" data-title="{{ $data->title }}" data-serial="{{ $loop->iteration }}" >{{ substr($data->title,0,20) .'...' }}</p>
                       <div class="d-flex justify-content-end ">
                            @if (Auth::user()->can('project.task.edit'))
                            <p class="text-dark icon edit" data-value={{ $data->id }} style="display: none; cursor: pointer"><i class="mt-1 fa fa-pencil text-primary  ">  </i></p>
                            @endif
                            @if (Auth::user()->can('project.task.delete'))
                            <form id="" action="{{ route('task.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-dark icon ml-2 delete"style="display: none; cursor: pointer;border-radius: 0; border: 0; background: transparent;"><i class="mt-1 fa fa-trash  text-danger ">  </i></button>
                            </form>
                            @endif
                        <p class="text-dark ml-3 "><i class=" fa fa-{{ $data->status == 0? 'exclamation' : 'check' }} {{$data->status == 0? 'text-danger': ' text-success'}} ">  </i></p>
                        </div>
                   </div>
                   @endforeach



                </div>
            </div>
            <div class="card ">
                <div class="card-header ">
                   <h6 class="font-weight-bold" > <span style="border-left: 4px solid #593bdb"> </span> &nbsp; Project Members</h6>

                </div>
                <div class=" mt-2 border-bottom"></div>
                <div class="">
                    <div class="d-flex justify-content-between py-2 px-3 border-bottom">
                        <p class=" text-dark pb-0 mb-0">Name</p>
                        <p class="text-dark pb-0 mb-0">Designation</p>
                    </div>
                    @foreach ($members as $data )

                    <div class="d-flex justify-content-between pt-3 px-3 border-bottom">
                        <p ><a href="{{route('employee.show',$data->id)}}"class=" ">{{$data->name}}</a></p>

                        <p class="text-dark"><i class="badge badge-outline-success text-success">  {{$data->employees->designations? $data->employees->designations->designation : 'UNKNOWN'}}</i></p>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="card ">
                <div class="card-header">
                    <h6 class="font-weight-bold mb-0">
                        <span style="border-left: 4px solid #593bdb;"></span>&nbsp; Project Documents
                    </h6>
                    @if (Auth::user()->can('project.file.add'))
                    <div class="file-upload btn btn-primary p-2" style="border-radius: 11%; height: 23px; width: 39px; coursor: pointer;">
                        <i class="fa fa-plus text-white" style="top: -7px; position: relative;"></i>
                        <div class="loading-overlay" id="loadingOverlay">
                            <div class="loading-spinner"></div>
                        </div>
                        <form id="fileForm" action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <input type="file" name="file" id="hiddenFileInput" onchange="submitForm()">
                        </form>
                    </div>
                    @endif
                </div>
                <div class=" mt-2 border-bottom"></div>
                <div class="">
                    @forelse ($files as $key=> $data )
                    <div class="d-flex justify-content-between py-2 px-3 border-bottom">
                        <p class=" text-dark pb-0 mb-0">{{substr($data,0,15).'...'}}</p>
                        <p class="text-dark pb-0 mb-0">
                            @if (Auth::user()->can('project.file.download'))
                            <a href="{{ route('download', ['filename' => $data]) }}" class="mr-2 badge badge-light"> <i class="fa fa-download text-primary "></i></a>
                            @endif
                            @if (Auth::user()->can('project.file.delete'))
                            <a href="{{route('projectFile.delete',['id' => $project->id, 'key' => $key])}}" class="badge badge-light"> <i class="fa fa-trash text-danger"></i></a>
                            @endif
                        </p>
                    </div>
                    @empty
                    <div class="text-center  py-2 px-3 border-bottom">
                        <p class="   pb-0 mb-0">EMPTY</p>

                    </div>
                    @endforelse


                </div>
            </div>
        </div>
    </div>

    {{-- edit task modal --}}
<div class="modal fade" id="editTask">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Task</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="taskUpdate" action="{{route('task.update', 0)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="">
                        <input type="hidden" name="taskUpdate" value="true">
                        <input type="text" name="task" id="taskTitle"  class="form-control" placeholder="Task Name" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn  btn-outline-primary float-right" style="font-size: 11px;">Update </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@else
<div class="row ">
    <div class="col-lg-6">
        <h3 class="display-5"> Project Overview</h3>
    </div>
    <div class="col-lg-6">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('project.index')}}">Projects</a></li>
            <li class="breadcrumb-item " ><a class="text-primary"> Project Overview</a></li>
        </ol>
    </div>

</div>
    <div class="row mb-5">
        <div class="col-lg-9 mb-5">
            <div class="card ">
                <div class="card-header ">
                   <h6 class="font-weight-bold mb-0" > <span style="border-left: 4px solid #593bdb"> </span> &nbsp; Project Details</h6>


                </div>
                <div class=" mt-2 border-bottom"></div>
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex ml-3">
                            <i class="fa fa-circle text-info  m-auto " style="font-size:9px;"></i>
                            <h4 class="ml-2 mb-0">{{$project->name}}</h4>
                        </div>
                    </div>
                    <div class="row mt-4  ml-1">
                        <h6 class="" style="margin-top: 2px; margin-right: 3px">Client : </h6> <span class="" style="margin-bottom: 0.5rem;"> {{ $project->client? $project->client->name : 'N/A'}}</span>
                    </div>

                    <div class="row mt-1 ml-1">
                        <h6 class="">Project Description:</h6>
                    </div>
                    <p class="ml-1">

                        {!!$project->description!!}
                    </p>
                    <hr>

                    <div class="row">

                            <div class=" between col-lg-4 col-md-4 col-sm-4 d-flex ">
                                <div class="d-inline-block  ">
                                    <p class="mb-0">Leader</p>
                                    <h6>
                                        {{$project->leader? $project->leader->name : 'UNASSIGNED'}}
                                    </h6>
                                </div>
                                <div class="float-right ">
                                    <p class="mb-0">Start Date</p>
                                <h6 class="">{{startDate($project->dateRange)}}</h6>
                                </div>
                            </div>
                            <div class=" between col-lg-4 col-md-4 col-sm-4 d-flex ">
                                <div class="d-inline-block ">
                                    <p class="mb-0">End Date</p>
                                    <h6>{{endDate($project->dateRange)}}</h6>
                                </div>
                                <div class="float-right ">
                                    <p class="mb-0">Members</p>
                                <h6 class="ml-4">
                                    @if($memberCount == 0)
                                        {{ 'N/A' }}
                                    @else
                                    {{$memberCount >= 5 ? '5+' : $memberCount}}
                                    @endif
                                </h6>
                                </div>
                            </div>
                            <div class=" between col-lg-4  col-md-4 col-sm-4 d-flex ">
                                <div class="d-inline-block ">
                                    <p class="mb-0">Status</p>
                                    <p class="badge badge-light text-warning"> {{$project->status}} </p>
                                </div>
                                <div class="float-right ">
                                    <p class="mb-0">Priority</p>
                                    <p class="badge badge-light text-info"> {{$project->priority}} </p>
                                </div>
                            </div>

                    </div>

                </div>
            </div>

        </div>
        <div class="col-lg-3">
            <div class="card ">
                <div class="card-header ">
                   <h6 class="font-weight-bold" > <span style="border-left: 4px solid #593bdb"> </span> &nbsp; Project Task </h6>
                    @if($project->leader_id == Auth::user()->id)
                        <button type="button" id="add" class=" btn btn-primary " data-toggle="modal" data-target="#createTask" style="font-size: -2px !important;height: 23px;width: 39px;">
                        <i class="fa fa-plus text-white" style="top: -5px; position: relative;"></i>
                        </button>
                    @endif
                </div>
                <div class=" mt-2 border-bottom"></div>
                <div class="">
                    @if ($project->tasks->count() == 0)
                    <div class="text-center  py-2 px-3 border-bottom">
                        <p class="   pb-0 mb-0">EMPTY</p>
                    </div>
                    @endif
                    @foreach ($project->tasks as $data )
                        <div class=" hover d-flex justify-content-between  pt-3 px-3 border-bottom">
                        <p class="text-dark fullText" data-title="{{ $data->title }}" data-serial="{{ $loop->iteration }}" >{{ substr($data->title,0,20) .'...' }}</p>
                        <div class="d-flex justify-content-end ">
                            @if ($project->leader_id == Auth::user()->id)
                            <p class="text-dark icon edit mr-3" data-value={{ $data->id }} style="display: none; cursor: pointer"><i class="mt-1 fa fa-pencil text-primary  ">  </i></p>
                            @endif
                            @if ($project->leader_id == Auth::user()->id)
                            <form id="" action="{{ route('task.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-dark icon mr-3 delete" style="display: none; cursor: pointer;border-radius: 0; border: 0; background: transparent;"><i class="mt-1 fa fa-trash  text-danger ">  </i></button>
                            </form>
                            @endif
                             <a href="{{ route('task.status.update', $data->id) }}" >
                                 <p class="text-dark  mr-1 update" style=" cursor: pointer"><i class="mt-1 fa fa-{{ $data->status == 1? 'check' : 'exclamation' }}  text-{{ $data->status == 1? 'success': 'danger' }} ">  </i></p>
                             </a>
                         </div>
                        </div>
                        @endforeach


                </div>
            </div>
            <div class="card ">
                <div class="card-header ">
                   <h6 class="font-weight-bold" > <span style="border-left: 4px solid #593bdb"> </span> &nbsp; Project Members</h6>
                   @if($project->leader_id == Auth::user()->id)
                   <button type="button" id="add" class=" btn btn-primary " data-toggle="modal" data-target="#addMember" style="font-size: -2px !important;height: 23px;width: 39px;">
                   <i class="fa fa-plus text-white" style="top: -5px; position: relative;"></i>
                   </button>
               @endif

                </div>
                <div class=" mt-2 border-bottom"></div>
                <div class="">
                    <div class="d-flex justify-content-between py-2 px-3 border-bottom">
                        <p class=" text-dark pb-0 mb-0">Name</p>
                        <p class="text-dark pb-0 mb-0">Designation</p>
                    </div>
                    @forelse ($members as $data )

                    <div class="d-flex hover justify-content-between pt-3 px-3 border-bottom">
                        <p >{{$data->name}}</p>
                        <div class="d-flex">
                            @if ($project->leader_id == Auth::user()->id)

                            <form class="" action="{{ route('member_delete', $data->employees->user->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="project_id" value="{{$project->id}}">

                                <button type="submit" class="text-dark icon mr-3 "style="display: none; cursor: pointer;border-radius: 0; border: 0; background: transparent;"><i class="mt-1 fa fa-trash  text-danger ">  </i></button>

                            </form>
                            @endif
                            <p class="text-dark"><i class="badge badge-outline-success text-success">
                                {{$data->employees->designations? $data->employees->designations->designation : 'UNKNOWN'}}</i></p>
                        </div>
                    </div>
                    @empty
                    @endforelse


                </div>
            </div>
            <div class="card ">
                <div class="card-header">
                    <h6 class="font-weight-bold mb-0">
                        <span style="border-left: 4px solid #593bdb;"></span>&nbsp; Project Documents
                    </h6>
                    @if ($project->leader_id == Auth::user()->id)
                    <div class="file-upload btn btn-primary p-2" style="border-radius: 11%; height: 23px; width: 39px; coursor: pointer;">
                        <i class="fa fa-plus text-white" style="top: -7px; position: relative;"></i>
                        <div class="loading-overlay" id="loadingOverlay">
                            <div class="loading-spinner"></div>
                        </div>
                        <form id="fileForm" action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <input type="file" name="file" id="hiddenFileInput" onchange="submitForm()">
                        </form>
                    </div>
                    @endif
                </div>
                <div class=" mt-2 border-bottom"></div>
                <div class="">
                    @forelse ($files as $key=> $data )
                    <div class="d-flex justify-content-between py-2 px-3 border-bottom">
                        <p class=" text-dark pb-0 mb-0">{{substr($data,0,15).'...'}}</p>
                        <p class="text-dark pb-0 mb-0">
                            <a href="{{ route('download', ['filename' => $data]) }}" class="mr-2 badge badge-light"> <i class="fa fa-download text-primary "></i></a>
                            @if ($project->leader_id == Auth::user()->id)
                            <a href="{{route('projectFile.delete',['id' => $project->id, 'key' => $key])}}" class="badge badge-light"> <i class="fa fa-trash text-danger"></i></a>
                            @endif
                        </p>
                    </div>
                    @empty
                    <div class="text-center  py-2 px-3 border-bottom">
                        <p class="   pb-0 mb-0">EMPTY</p>

                    </div>
                    @endforelse


                </div>
            </div>
        </div>
    </div>

    @if($project->leader_id == Auth::user()->id)
        {{-- edit task modal --}}
        <div class="modal fade" id="editTask">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Task</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="taskUpdate" action="{{route('task.update', 0)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="">
                                <input type="hidden" name="taskUpdate" value="true">
                                <input type="text" name="task" id="taskTitle"  class="form-control" placeholder="Task Name" required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn  btn-outline-primary float-right" style="font-size: 11px;">Update </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
            {{-- member add modal --}}
    <div class="modal fade" id="addMember">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Member</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="" action="{{route('project_member_update')}}" method="POST">
                        @csrf
                        <div class="">
                            <input type="hidden" name="project_id" value="{{$project->id}}">
                           <label for="" class="form-label">Select Member</label>
                           <select name="updateMember[]" id="" class="multi-select" multiple="multiple" required>
                               @foreach ($notmember as $data)
                                   <option value="{{$data->user->id}}">{{$data->user->name}}</option>
                               @endforeach
                           </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn  btn-outline-primary float-right" style="font-size: 11px;">Update </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @endif
@endif
    {{-- task modal --}}
    <div class="modal fade" id="createTask">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('task.store')}}" method="POST">
                        @csrf
                        <div class="">
                            <input type="hidden" name="project_id" value="{{$project->id}}">
                            <input type="text" name="task" class="form-control" placeholder="Task Name" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn  btn-outline-primary float-right" style="font-size: 11px;">Add </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- task show modal --}}
    <div class="modal fade" id="taskShowModal">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="border-left: 2px solid #593bdb">
                    <span class="modal-title ml-1" id="titleNo" ></span></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <p id="modalTitle" class="text-dark"></p>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{asset('dashboard_assets/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/plugins-init/select2-init.js')}}"></script>
<script>
    $(document).ready(function() {

        $('.hamburger').trigger('click');
    });
</script>
<script>
    function submitForm() {
        document.getElementById('loadingOverlay').style.display = 'flex';
        // Show loading overlay

        // Submit the form
        document.getElementById('fileForm').submit();
    }
</script>

<script>
    // Get all elements with the 'copyable' class
    var copyableElements = document.querySelectorAll('.copyable');

    // Add click event listener to each copyable element
    copyableElements.forEach(function(element) {
        element.addEventListener('click', function(event) {
            // Prevent the default behavior of the click event
            event.preventDefault();

            // Get the text to copy from the 'data-title' attribute
            var text = this.getAttribute('data-title');

            // Copy the text to the clipboard
            navigator.clipboard.writeText(text).then(function() {
                // Create a small note to indicate that the text has been copied
                var note = document.createElement('span');
                note.classList.add('copy-note');
                note.textContent = 'Text copied';

                // Apply styles to the note
                note.style.backgroundColor = '#ffffff'; // White background
                note.style.color = '#000000'; // Black text
                note.style.border = '1px solid #000000'; // Black border
                note.style.borderRadious = '4px'; // Black border
                note.style.padding = '4px'; // Padding for spacing

                // Position the note where the mouse cursor was clicked
                note.style.position = 'absolute';
                note.style.left = event.clientX + 'px';
                note.style.top = event.clientY + 'px';

                // Append the note to the body
                document.body.appendChild(note);

                // Remove the note after a short delay (e.g., 2 seconds)
                setTimeout(function() {
                    document.body.removeChild(note);
                }, 1000);
            }).catch(function(err) {
                // Handle errors
                console.error('Failed to copy text: ', err);
            });
        });
    });
</script>
<script>
     $(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('click', '.edit', function () {
        var id = $(this).data('value');
        modal = $('#editTask');
        modal.modal('show');


            // Construct the route dynamically
        var route = "{{ route('task.edit', ['task' => ':id']) }}";
        route = route.replace(':id', id);
        $.get(route, function(data) {
            $('#taskTitle').val(data.title);
        });
        var form = $('#taskUpdate');
            var action = form.attr('action');
            // Replace the last part of the action attribute with the new id
            action = action.substring(0, action.lastIndexOf('/') + 1) + id;
            form.attr('action', action);
    });
    $('body').on('click', '.delete', function () {
        $('#taskDelete').submit();
    });
    $('body').on('click', '.deleteMember', function () {
        $('.memberDelete').submit();
    });
    $('body').on('click', '.update', function () {
        $('#taskUpdate').submit();
    });
    });

</script>
<script>
    $(document).ready(function(){
    $('.fullText').click(function(){
        var title = $(this).data('title');
        var serial = $(this).data('serial');

        $('#modalTitle').text(title);
        $('#titleNo').text(' Task '+serial);
        $('#taskShowModal').modal('show');
    });
});

</script>
@endsection
