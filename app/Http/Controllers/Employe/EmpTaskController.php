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
    public function index(){
        $projects = Project::orderBy('id','desc')->get();
        return view('employe.task.list',compact('projects'));
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
}
