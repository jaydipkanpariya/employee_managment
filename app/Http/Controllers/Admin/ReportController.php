<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function task_report(Request $request)
    {
        if ($request->ajax()) {
            $data = Task::with('projects', 'employee')->orderBy('id', 'DESC')->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('project_name', function ($row) {
                    return @$row->projects->name;
                })
                ->addColumn('user_name', function ($row) {
                    return @$row->employee->name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-outline-warning mx-1 edit" onclick="viewemployestask(' . $row->id . ')" data-bs-toggle="modal" data-bs-target="#Edit-Category-Modal">
                                    <i class="far fa-edit"></i>
                                </a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $projects = Project::orderBy('id', 'DESC')->select('*')->get();
        return view('admin.report.task_report',compact('projects'));
    }
}
