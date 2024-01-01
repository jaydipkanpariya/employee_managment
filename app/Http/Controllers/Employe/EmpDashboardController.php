<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\Notice;
use App\Models\Employes;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EmpDashboardController extends Controller
{
    public function dashboard(Request $request) {
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
        if ($request->ajax()) {
            $data = Notice::orderBy('id', 'DESC')->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-outline-warning mx-1 edit" onclick="viewproject(' . $row->id . ')" data-bs-toggle="modal" data-bs-target="#Edit-Category-Modal">
                                    <i class="far fa-eye"></i>
                                </a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employe.dashboard', compact('emp_name','maxTotalHours','last_seven_day_sum','current_month_sum','total_hours','total_project'));

    }

    public function view($id)
    {
        $pro = Notice::find($id);
        return view('employe.notice.view', compact('pro'));
    }
    public function emp_note($id)
    {
        Employes::where('id',$id)->update([
            'note' => 0
        ]);
        return response()->json(['status' => 'success']);
    }
    public function update_password($id)
    {
        return $id;
    }
}
