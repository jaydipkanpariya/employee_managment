<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index(){
        return view('admin.project.list');
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $employee = new Project();
            $employee->name = $request->name;
            $employee->client_name = $request->client_name;
            $employee->date = $request->date;
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
