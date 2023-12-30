<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\Employes;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (!Auth::guard('admin')->user()) {
            return view('admin.login');
        }
        $total_project = Project::count();
        $employees = Employes::all();
        $projects = Project::all();


        $tasks = Task::query();

        $last_seven_day_start = now()->subDays(7)->startOfDay();
        $last_seven_day_end = now()->endOfDay();
        $last_seven_day = clone $tasks;
        $last_seven_day_sum = $last_seven_day->whereBetween('date', [$last_seven_day_start->format('Y-m-d'), $last_seven_day_end->format('Y-m-d')])->sum('hours');

        $current_month_start = now()->firstOfMonth()->startOfDay();
        $current_month_end = now()->lastOfMonth()->endOfDay();
        $current_month = clone $tasks;
        $current_month_sum = $current_month->whereBetween('date', [$current_month_start->format('Y-m-d'), $current_month_end->format('Y-m-d')])->sum('hours');

        $clone = clone $tasks;
        $total_hours = $clone->sum('hours');




        $firstDayOfLastMonth = Carbon::now()->subMonth()->firstOfMonth();
        $lastDayOfLastMonth = Carbon::now()->subMonth()->endOfMonth();
        $result = Task::with('employee')
            ->select(DB::raw('sum(hours) as total_hours'), 'user_id')
            ->whereBetween('date', [$firstDayOfLastMonth, $lastDayOfLastMonth])
            ->groupBy('user_id')
            ->orderByDesc('total_hours')
            ->first();

        $maxTotalHours = $result->total_hours ?? 0 ;
        $emp_name = $result->employee['name'] ?? 0;



        return view('admin.dashboard', compact('emp_name','maxTotalHours','employees', 'projects', 'last_seven_day_sum', 'current_month_sum', 'total_hours', 'total_project'));
    }
}
