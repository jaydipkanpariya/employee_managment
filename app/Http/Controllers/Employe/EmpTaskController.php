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

class EmpTaskController extends Controller
{
    public function index(Request $request)
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

        return view('employe.task.list', compact('projects'));
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
            $employee->user_id = Auth::guard('employe')->user()->id;
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
}
