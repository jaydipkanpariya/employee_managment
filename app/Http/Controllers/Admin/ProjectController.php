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
    public function index(Request $request){

        if ($request->ajax()) {
            $data = Project::orderBy('id', 'DESC')->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-outline-warning mx-1 edit" onclick="viewproject(' . $row->id . ')" data-bs-toggle="modal" data-bs-target="#Edit-Category-Modal">
                                    <i class="far fa-edit"></i>
                                </a>';

                    $btn .= '<a href="javascript:void(0)" class="btn btn-outline-danger mx-1 delete mytest"  href="javascript:void(0);"  data-url="' . route('project.delete', $row->id) . '" data-bs-toggle="modal" data-bs-target="#Delete">
                                    <i class="far fa-trash-alt"></i>
                                </a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

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
    public function edit($id)
    {
        $pro = Project::find($id);
        return view('admin.project.edit', compact('pro'));
    }
    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $Payment = Project::find($id);
                $Payment->delete();
            }, 5);
            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}
