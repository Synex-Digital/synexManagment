@extends('dashboard.layouts.app')
@php

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

<link href="{{asset('dashboard_assets/vendor/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
@endsection
@section('content')


<div class="row">
    <div class="col-lg-5">
        <div class="row">
            @if (auth()->user()->can('project.view'))
            <div class=" col-lg-6 col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Projects</h5>
                    <p class="font-weight-bold" style="font-size: 23px; color: black">Total: {{ $totalProjects }} </p>

                    <div class="border-bottom mb-1">  </div>
                    <p class="card-text">Pending Projects <span class="badge bg-primary text-white"> {{ $pendingProject }}</span> </p>
                    </div>
                </div>
            </div>

            <div class=" col-lg-6 col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tasks</h5>
                        <p class="font-weight-bold" style="font-size: 23px; color: black">Total: {{ $tasks->count() }}  </p>

                        <div class="border-bottom mb-1">  </div>
                        <p class="card-text">Pending Tasks <span class="badge bg-primary text-white">{{ $pendingTask }} </span> </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <div class="year-calendar"></div>
            </div>
        </div>
    </div>
        @if (auth()->user()->can('project.view'))
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Recent Tasks</h5>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  " >
                            <thead>
                                <tr class="text-dark">
                                    <th>Task Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($taskFour as $data )
                                    <tr>
                                        <td class="w-100">{{$data->title }}</td>
                                        {{-- <td class="w-100">{{ substr($data->title,0,40) .'...' }}</td> --}}
                                        <td>
                                            <a href="{{ route('task.status.update', $data->id) }}" >
                                                <p class="text-dark  ml-2 " style=" cursor: pointer"><i class="mt-1 fa fa-{{ $data->status == 1? 'check' : 'exclamation' }}  text-{{ $data->status == 1? 'success': 'danger' }} ">  </i></p>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">NO DATA FOUND</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Recent Projects</h5>

                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table " >
                            <thead>
                                <tr class="text-dark">

                                    <th>Project Name</th>
                                    <th>Leader</th>

                                    <th>Deadline</th>

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projectSix as $data )
                                    <tr>

                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->leader? $data->leader->name : 'UNASSIGNED'  }}</td>
                                        <td>
                                            {{ endDate($data->dateRange) }}
                                        </td>

                                        <td style="font-size: 10px;">
                                            <span class="badge
                                                @if ($data->status == 'INPROGRESS')
                                                    badge-secondary
                                                @elseif ($data->status == 'ON-HOLD')
                                                    badge-warning
                                                @elseif ($data->status == 'COMPLETED')
                                                    badge-success
                                                @endif
                                                ">
                                            {{ $data->status }}
                                        </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('employee.project.overview', $data->id) }}" class="btn btn-outline-primary btn-sm " style="height: 24px">
                                            <span style="font-size: 10px; position: relative; top: -5px">view</span>
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                <tr>

                                    <td colspan="5" class="text-center">NO DATA FOUND</td>

                                </tr>
                                @endforelse


                            </tbody>

                        </table>
                    </div>
                    </div>
                </div>
                    <div class="row">



                    </div>

                        <!-- /# card -->
            </div>
        @endif
    </div>


    <!-- Add similar divs for Expenses and Profit sections -->
</div>
 <div class="row">

    <div class="col-lg-7">



</div>




@endsection
@section('script')
<script src="{{asset('dashboard_assets/vendor/pg-calendar/js/pignose.calendar.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/dashboard/dashboard-2.js')}}"></script>
@endsection
