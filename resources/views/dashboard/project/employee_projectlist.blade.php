@extends('dashboard.layouts.app')
@php
    function dateLeft($dbDate, $status){
        if ($status == 'COMPLETED') {
            return "End";
        }else{
            // Split the date range string into start and end dates
            $dates = explode(' - ', $dbDate);
            // Convert end date to DateTime object
            $endDate = $dates[1];
            $endDate2 = DateTime::createFromFormat('m/d/Y', $endDate);

            // Get today's date
            $today = now()->format('m/d/Y');
            $today2 = new DateTime();

            // Calculate remaining days

            $interval = $today2->diff($endDate2);
            $daysLeft = $interval->days;

            //Display remaining days
            if ($endDate < $today) {
                return "Due $daysLeft days";
            } elseif ($endDate == 0) {
                return "Due Today";
            } elseif ($endDate == 1) {
                return "1 day left";
            } else {
                return "$daysLeft days left";
            }
        }

    }
    function dateConvert($date){
        // Assuming $data->dateRange contains the date string "05/21/2024 - 05/22/2024"
        $dateRange = $date;

        // Explode the date string into an array
        $dates = explode(" - ", $dateRange);

        // Convert the dates into the desired format
        $start_date = DateTime::createFromFormat('m/d/Y', $dates[0])->format('M-d-y');
        $end_date = DateTime::createFromFormat('m/d/Y', $dates[1])->format('M-d-y');
        return $start_date . ' - ' . $end_date;

    }

@endphp
@section('style')
<link href="{{asset('dashboard_assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')


<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Projects</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Projects</li>
            <li class="breadcrumb-item " ><a class="text-primary">Project List</a></li>
        </ol>
    </div>

</div>
    <div class="row mb-5">
        <div class="col-lg-12 mb-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">employee Project List</h4>



                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project Name</th>
                                    <th>Leader</th>
                                    <th>Deadline</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $data )
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->name}} </td>
                                        <td>{{$data->leader? $data->leader->name : 'UNASSIGNED'}}</td>
                                        <td>
                                            <span class="badge badge-light text-primary badge-xs" style="font-size: 10px">{{dateConvert($data->dateRange)}}</span>
                                           <span class="badge badge-light text-info badge-xs"> {{ dateLeft($data->dateRange, $data->status) }}</span>

                                        </td>

                                        <td><span class="badge badge-light text-warning">{{$data->priority}}</span> </td>
                                        <td> <span class="badge badge-light text-success">{{$data->status}}</span> </td>
                                        <td class="d-flex justify-content-spacebetween">
                                            <a href="{{route('employee.project.overview',$data->id) }}" class=" btn btn-outline-primary btn-sm mr-1  "> <i class="fa fa-eye "></i></a>

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

    <!-- Datatable -->
    <script src="{{asset('dashboard_assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/plugins-init/datatables.init.js')}}"></script>
@endsection
