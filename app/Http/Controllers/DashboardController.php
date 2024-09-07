<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\AppSetting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    public function index(){
        if(auth()->user()->can('project.edit')){
            $start_month = Carbon::now()->startOfMonth();
            $end_month = Carbon::now()->endOfMonth();
            $current_month_budget = DB::table('projects')->whereBetween('created_at',[$start_month, $end_month])->sum('budget');
            $last_month = Carbon::now()->subMonth()->startOfMonth();
            $lastMonth_end = Carbon::now()->subMonth()->endOfMonth();
            $last_month_budget = DB::table('projects')->whereBetween('created_at',[$last_month, $lastMonth_end])->sum('budget');
            $total_budget = DB::table('projects')->sum('budget');
            if ($last_month_budget != 0) {
                $percentageBudget = (($current_month_budget - $last_month_budget) / $last_month_budget) * 100;
            } else {
                $percentageBudget = $current_month_budget > 0 ? 100 : 0;
            }
            $percentageBudget = round($percentageBudget, 2);

            //////////////
            $current_month_amount = DB::table('expenses')->whereBetween('date',[$start_month, $end_month])->sum('amount');
            $last_month_amount = DB::table('expenses')->whereBetween('date',[$last_month, $lastMonth_end])->sum('amount');

            if ($last_month_amount != 0) {
                $percentageAmount = (($current_month_amount - $last_month_amount) / $last_month_amount) * 100;
            } else {
                $percentageAmount = $current_month_amount > 0 ? 100 : 0;
            }
            $percentageAmount = round($percentageAmount, 2);
            /////////////
            $current_profit = $current_month_budget - $current_month_amount;
            $last_profit = $last_month_budget - $last_month_amount;
            if ($last_profit != 0) {
                $percentageProfit = (($current_profit - $last_profit) / $last_profit) * 100;
            } else {
                $percentageProfit = $current_profit > 0 ? 100 : 0;
            }
            $percentageProfit = round($percentageProfit, 2);
            //////////////
            $project_count = DB::table('projects')->count();
            $projects = Project::orderBy('id','desc')->take(7)->get();
            $project_pending = DB::table('projects')->where('status','!=','COMPLETED')->count();
            //////////////////
            $employee = DB::table('employees')->count();
            $client = DB::table('clients')->count();
            $task = DB::table('tasks')->count();
            //////////////
            $expenses = DB::table('expenses')->orderBy('id','desc')->take(6)->get();


            return view('dashboard.index',[
                'current_month_budget' => $current_month_budget,
                'last_month_budget' => $last_month_budget,
                'percentageBudget' => $percentageBudget,
                'current_month_amount' => $current_month_amount,
                'last_month_amount' => $last_month_amount,
                'percentageAmount' => $percentageAmount,
                'current_profit' => $current_profit,
                'last_profit' => $last_profit,
                'percentageProfit' => $percentageProfit,
                'project_count' => $project_count,
                'projects' => $projects,
                'project_pending' => $project_pending,
                'employee' => $employee,
                'client' => $client,
                'task' => $task,
                'total_budget' => $total_budget,
                'expenses' => $expenses
            ]);
        }else{
            $user = Auth::user();

            $projects = $user->allProjects();
            $projectSix = $projects->take(6);
            $totalProjects = $projects->count();
            $pendingProject = $projects->where('status','!=','COMPLETED')->count();
            $projectIds = $projects->pluck('id');
            $tasks = Task::whereIn('project_id', $projectIds)->get();
            $taskFour = $tasks->take(4);
            $pendingTask = $tasks->where('status',' =','0')->count();



            return view('dashboard.employee_index',[
                'projects' => $projects,
                'projectSix' => $projectSix,
                'totalProjects' => $totalProjects,
                'pendingProject' => $pendingProject,
                'tasks' => $tasks,
                'taskFour' => $taskFour,
                'pendingTask' => $pendingTask,

            ]);
        }

    }

    public function showAppSetting(){
        return view('dashboard.app_setting.index');
    }

    public function logoIcon_store(Request $request){

        if($request->logoIcon){
            $file = $request->logoIcon;
            $extension = $file->getClientOriginalExtension();
            $logoIcon ='LOGO_ICON_'.Str::random(8).'.'.$extension;
           Image::make($file)->save( public_path('uploads/logo/'.$logoIcon));
           AppSetting::updateOrCreate(
                ['id' => 1],
                [
                    'logoIcon' => $logoIcon,
                ]
            );


        }
        if($request->logoText){
            $file = $request->logoText ;
            $extension = $file->getClientOriginalExtension();
            $logoText ='LOGO_TEXT_'.Str::random(8).'.'.$extension;
           Image::make($file)->save( public_path('uploads/logo/'.$logoText));
           AppSetting::updateOrCreate(
                ['id' => 1],
                [

                    'logoText' => $logoText,
                ]
            );

        }


        flash()->options(['position' => 'bottom-right'])->success('Logo updated successfully');
        return back();

    }





}
