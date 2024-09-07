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
    $user = Auth::user();
@endphp

@section('style')

<link href="{{asset('dashboard_assets/vendor/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">

@endsection
@section('content')


<div class="row">

    @if ($user->can('dashboard.earnings'))
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Earnings<span class="badge float-right bg-primary text-white">{{ $percentageBudget }}%</span></h5>
            <p class="font-weight-bold" style="font-size: 23px; color: black">৳{{ $current_month_budget }} </p>
            <div class="border-bottom mb-1">  </div>
            <p class="card-text"><span class="text-muted">Previous Month</span> ৳{{ $last_month_budget }}</p>
            </div>
        </div>
    </div>
    @endif
    @if ($user->can('dashboard.expenses'))
    <div class="col-md-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Expenses<span class="badge float-right bg-primary text-white">{{ $percentageAmount }}%</span></h5>
        <p class="font-weight-bold" style="font-size: 23px; color: black">৳{{ $current_month_amount }} </p>
        <div class="border-bottom mb-1">  </div>


        <p class="card-text"><span class="text-muted">Previous Month</span> ৳{{ $last_month_amount }}</p>
        </div>
    </div>
    </div>
    @endif
    @if ($user->can('dashboard.profit'))
    <div class="col-md-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Profit<span class="badge float-right bg-primary text-white">{{ $percentageProfit }}%</span></h5>
        <p class="font-weight-bold" style="font-size: 23px; color: black">৳{{ $current_profit }} </p>
        <div class="border-bottom mb-1">  </div>
        <p class="card-text"><span class="text-muted">Previous Month</span> ৳{{ $last_profit  }}</p>
        </div>
    </div>
    </div>
    @endif
    @if ($user->can('dashboard.projects'))
    <div class="col-md-3">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Projects</h5>
        <p class="font-weight-bold" style="font-size: 23px; color: black">{{ $project_count }} </p>

        <div class="border-bottom mb-1">  </div>
        <p class="card-text">Pending Projects <span class="badge bg-primary text-white"> {{ $project_pending }}</span> </p>
        </div>
    </div>
    </div>
    @endif

    <!-- Add similar divs for Expenses and Profit sections -->
</div>
<div class="row">
    @if ($user->can('dashboard.employee'))
    <div class="col-lg-3 col-sm-3">
        <div class="card">
            <div class="stat-widget-one card-body">
                <div class="stat-icon d-inline-block" ">
                    <i class="ti-user text-success border-success"></i>
                </div>
                <div class="stat-content d-inline-block" style="margin-left:16px!important;">
                    <div class="stat-text">Employee</div>

                    <div class="stat-digit">{{ $employee }}</div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if ($user->can('dashboard.client'))
    <div class="col-lg-3 col-sm-3">
        <div class="card">
            <div class="stat-widget-one card-body">
                <div class="stat-icon d-inline-block" ">
                    <i class="ti-headphone-alt text-warning border-warning"></i>
                </div>
                <div class="stat-content d-inline-block" style="margin-left:16px!important;">
                    <div class="stat-text">Client </div>
                    <div class="stat-digit">{{ $client }}</div>
                </div>
            </div>
        </div>
   </div>
    @endif
    @if ($user->can('dashboard.earnings'))
    <div class="col-lg-3 col-sm-3">
        <div class="card">
            <div class="stat-widget-one card-body">
                <div class="stat-icon d-inline-block" ">
                    <i class="ti-credit-card text-primary border-primary"></i>
                </div>
                <div class="stat-content d-inline-block" style="margin-left:16px!important;">
                    <div class="stat-text">Total Earnings   </div>
                    <div class="stat-digit">{{ $total_budget }}</div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($user->can('project.overView'))
    <div class="col-lg-3 col-sm-3">
        <div class="card">
            <div class="stat-widget-one card-body">
                <div class="stat-icon d-inline-block" ">
                    <i class="ti-notepad text-primary border-primary"></i>
                </div>
                <div class="stat-content d-inline-block" style="margin-left:16px!important;">
                    <div class="stat-text">Task</div>
                    <div class="stat-digit">{{ $task }}</div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
 <div class="row">
    <div class="col-lg-8">

        @if ($user->can('project.view'))
        <div class="card">
            <div class="card-header">
                <h5>Recent Projects</h5>
                @if ($user->can('project.create'))
                <a href="{{ route('project.create') }}" class=" btn btn-outline-primary " style="font-size: 11px !important;">New </a>
                @endif
            </div>
            <div class="card-body" style="    padding-bottom: 2px;">
            <div class="table-responsive">
                <table class="table " >
                    <thead>
                        <tr class="text-dark">

                            <th>Project Name</th>
                            <th>Leader</th>

                            <th>Deadline</th>

                            <th>Status</th>
                            @if ($user->can('project.overView'))
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $data )
                            <tr>

                                <td class="text-dark">{{ $data->name }}</td>
                                <td >
                                    @if($data->leader)
                                    <a href="{{ route('employee.show', $data->leader->id)  }}">{{ $data->leader->name  }}</a>
                                    @else
                                    {{ 'UNASSIGNED' }}
                                    @endif
                                </td>
                                <td class="text-dark">
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
                                @if ($user->can('project.overView'))
                                <td class="text-dark">
                                    <a href="{{route('project.show',$data->id) }}" title="View" class=" btn btn-outline-primary btn-sm mr-1  " style="font-size: 11px !important;"> view</a>
                                </td>
                                @endif


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
        @endif


                <!-- /# card -->
    </div>
     <div class="col-lg-4">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="year-calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
{{-- recent projects --}}
@if ($user->can('expenses.view'))
<div class="row">
  <div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">All Expense</h4>
            @if ($user->can('expenses.create'))
            <a href="{{ route('expenses.index') }}" class=" btn btn-outline-primary " style="font-size: 11px !important;">New</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table student-data-table m-t-20">
                    <thead>
                        <tr>
                            <th class="text-dark">Date</th>
                            <th class="text-dark">Expense Type</th>
                            <th class="text-dark">Amount</th>
                            <th class="text-dark">Purchased By</th>
                            {{-- <th>Action</th> --}}

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expenses as $data )
                        <tr>
                            <td class="text-dark">{{ \Carbon\Carbon::parse($data->date)->format('d-M-y') }}
                            </td>
                            <td class="text-dark">
                                {{ $data->type  }}
                            </td>
                            <td class="text-dark">
                                ৳{{ $data->amount }}
                            </td>

                            <td class="text-dark">
                               {{ $data->purchase_by }}
                            </td>
                           {{--  <td>
                                @if ($user->can('expenses.overview'))
                                    <a href="{{ route('project.show', $data->id) }}" class="btn btn-outline-primary btn-sm " style="height: 24px">
                                    <span style="font-size: 10px; position: relative; top: -5px">view</span>
                                    </a>
                                    @endif
                            </td>--}}

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
@endif


@endsection
@section('script')
<script src="{{asset('dashboard_assets/vendor/pg-calendar/js/pignose.calendar.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/dashboard/dashboard-2.js')}}"></script>
@endsection
