<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Employes;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(){
        return view('admin.employee.list');
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $employee = new Employes();
            $employee->name = $request->name;
            $employee->emp_email = $request->emp_email;
            $employee->emp_mobile = $request->emp_mobile;
            $employee->password = $request->emp_mobile;
            $employee->emp_code = 1;
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
