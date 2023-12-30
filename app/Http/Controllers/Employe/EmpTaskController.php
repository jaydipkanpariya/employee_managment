<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\Employes;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EmpTaskController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::guard('admin')->user() || Auth::guard('employe')->user()) {

            if ($request->ajax()) {
                $total_tasks = Task::query();
                if (Auth::guard('employe')->user()) {
                    $total_tasks->where('user_id', Auth::guard('employe')->user()->id);
                }
                if (isset($request['from']) && $request['from'] != "" && !empty($request['from'])) {
                    $total_tasks->whereDate('date', ' >= ', date("Y-m-d", strtotime($request['from'])));
                }
                if (isset($request['to']) && $request['to'] != "" && !empty($request['to'])) {
                    $total_tasks->whereDate('date', ' <= ', date("Y-m-d", strtotime($request['to'])));
                }
                if (isset($request['project']) && $request['project'] != "" && !empty($request['project'])) {
                    $total_tasks->where('project', $request['project']);
                }
                if (isset($request['employee']) && $request['employee'] != "" && !empty($request['employee'])) {
                    $total_tasks->where('user_id', $request['employee']);
                }
                $total_hours = $total_tasks->sum('hours');

                //  datatable
                $query = Task::with('projects', 'employee');
                if (Auth::guard('employe')->user()) {
                    $query->where('user_id', Auth::guard('employe')->user()->id);
                }
                $data = $query->orderBy('id', 'DESC')
                    ->select('*');

                $table = Datatables::of($data)
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
                    ->filter(function ($query) use ($request) {
                        if (isset($request['from']) && $request['from'] != "" && !empty($request['from'])) {
                            $query->whereDate('date', ' >= ', date("Y-m-d", strtotime($request['from'])));
                        }
                        if (isset($request['to']) && $request['to'] != "" && !empty($request['to'])) {
                            $query->whereDate('date', ' <= ', date("Y-m-d", strtotime($request['to'])));
                        }
                        if (isset($request['project']) && $request['project'] != "" && !empty($request['project'])) {
                            $query->where('project', $request['project']);
                        }
                        if (isset($request['employee']) && $request['employee'] != "" && !empty($request['employee'])) {
                            $query->where('user_id', $request['employee']);
                        }
                    })
                    ->rawColumns(['action'])
                    ->make(true);

                return response()->json([
                    'data' => $table,
                    'total_hours' => $total_hours,
                ]);
            }
            $projects = Project::orderBy('id', 'DESC')->select('*')->get();
            $employees = Employes::all();

            return view('employe.task.list', compact('projects', 'employees'));
        } else {
            return view('admin.login');

        }
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $employee = new Task();
            $employee->project = $request->project;
            $employee->hours = $request->hours;
            $employee->date = $request->date;
            $employee->remarks = $request->remarks;
            $employee->user_id = Auth::guard('employe')->user()->id;
            $employee->save();
            DB::commit();
            $response_array = ['status_code' => 200, 'status' => "success", 'message' => 'Inserted Successfully'];
            return response()->json($response_array, 200);
        } catch (Exception $e) {
            $error_messages = $e->getmessage();
            $error_code = $e->getcode();
            $response_array = ['error_code' => 500, 'success' => false, 'error_messages' => $error_messages];
            return response()->json($response_array, 500);
        }
    }

    public function edit($id)
    {
        $projects = Project::orderBy('id', 'DESC')->get();
        $emptask = Task::find($id);
        return view('employe.task.edit', compact('emptask', 'projects'));
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $employee = Task::find($request->id);
            $employee->project = $request->project;
            $employee->hours = $request->hours;
            $employee->date = $request->date;
            $employee->remarks = $request->remarks;
            if (Auth::guard('admin')->user()) {
                $employee->updated_by = Auth::guard('admin')->user()->id;
            }
            $employee->save();

            DB::commit();
            $response_array = ['status_code' => 200, 'status' => "success"];
            return response()->json($response_array, 200);
        } catch (Exception $e) {
            $error_messages = $e->getmessage();
            $error_code = $e->getcode();
            $response_array = ['error_code' => 500, 'success' => false, 'error_messages' => $error_messages];
            return response()->json($response_array, 500);
        }
    }

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
        return view('employe.report.task_report', compact('projects'));
    }
}
