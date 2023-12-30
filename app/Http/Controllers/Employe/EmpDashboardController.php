<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EmpDashboardController extends Controller
{
    public function dashboard() {
        if (!Auth::guard('employe')->user()) {
            return view('employe.login');
        }
        $total_project = Project::count();
        $tasks = Task::where('user_id',Auth::guard('employe')->user()->id);

        $last_seven_day_start = now()->subDays(7)->startOfDay();
        $last_seven_day_end = now()->endOfDay();
        $last_seven_day_sum = $tasks->whereBetween('date', [$last_seven_day_start->format('Y-m-d'), $last_seven_day_end->format('Y-m-d')])->sum('hours');

        $current_month_start = now()->firstOfMonth()->startOfDay();
        $current_month_end = now()->lastOfMonth()->endOfDay();
        $current_month_sum = $tasks->whereBetween('date', [$current_month_start->format('Y-m-d'), $current_month_end->format('Y-m-d')])->sum('hours');

        $total_hours = $tasks->sum('hours');


        return view('employe.dashboard', compact('last_seven_day_sum','current_month_sum','total_hours','total_project'));

    }
}
