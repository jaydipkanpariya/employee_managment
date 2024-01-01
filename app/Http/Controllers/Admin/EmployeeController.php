<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employes;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employes::orderBy('id', 'DESC')->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-outline-warning mx-1 edit" onclick="viewemployes(' . $row->id . ')" data-bs-toggle="modal" data-bs-target="#Edit-Category-Modal">
                                    <i class="far fa-edit"></i>
                                </a>';

                    $btn .= '<a href="javascript:void(0)" class="btn btn-outline-danger mx-1 delete mytest"  href="javascript:void(0);"  data-url="' . route('employee.delete', $row->id) . '" data-bs-toggle="modal" data-bs-target="#Delete">
                                    <i class="far fa-trash-alt"></i>
                                </a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.employee.list');
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $password = $this->generateRandomPassword();
            $employee = new Employes();
            $employee->emp_code = $request->emp_code;
            $employee->name = $request->name;
            $employee->emp_email = $request->emp_email;
            $employee->emp_mobile = $request->emp_mobile;
            $employee->password = Hash::make($password);
            $employee->raw_password = $password;
            $employee->save();
            $toemail = $request->emp_email;
            $employe = Employes::find($employee->id);
            $employeeData = $employe->toArray();
            Mail::send('mail', ['employe' => $employeeData], function ($message) use ($toemail) {
                $message->from('jaydiptestmail@gmail.com', 'jaydiptestmail@gmail.com')
                    ->to($toemail)
                    ->subject('Reset Password')
                    ->setBody('Your email content goes here');
            });
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
    function generateRandomPassword()
    {
        $length = rand(8, 9);
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        return Str::random($length, $characters);
    }
    public function edit($id)
    {
        $emp = Employes::find($id);
        return view('admin.employee.edit', compact('emp'));
    }
    public function update(Request $request){
        try {
            DB::beginTransaction();

            $employee = Employes::find($request->id);
            $employee->emp_code = $request->emp_code;
            $employee->name = $request->name;
            $employee->emp_email = $request->emp_email;
            $employee->emp_mobile = $request->emp_mobile;
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
    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $Payment = Employes::find($id);
                $Payment->delete();
            }, 5);
            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}
