<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Employes;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Notice::orderBy('id', 'DESC')->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-outline-warning mx-1 edit" onclick="viewproject(' . $row->id . ')" data-bs-toggle="modal" data-bs-target="#Edit-Category-Modal">
                                    <i class="far fa-edit"></i>
                                </a>';

                    $btn .= '<a href="javascript:void(0)" class="btn btn-outline-danger mx-1 delete mytest"  href="javascript:void(0);"  data-url="' . route('notice.delete', $row->id) . '" data-bs-toggle="modal" data-bs-target="#Delete">
                                    <i class="far fa-trash-alt"></i>
                                </a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.notice.list');
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $employee = new Notice();
            $employee->user_id = Auth::guard('admin')->user()->id;
            $employee->description = $request->description;
            $employee->title = $request->title;
            $employee->date = $request->date;
            $employee->save();
            $llRecords = Employes::all();
            foreach ($llRecords as $record) {
                $record->update([
                    'note' => 1
                ]);
            }
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
        $pro = Notice::find($id);
        return view('admin.notice.edit', compact('pro'));
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $employee = Notice::find($request->id);
            $employee->user_id = Auth::guard('admin')->user()->id;
            $employee->description = $request->description;
            $employee->title = $request->title;
            $employee->date = $request->date;
            $employee->save();
            $llRecords = Employes::all();
            foreach ($llRecords as $record) {
                $record->update([
                    'note' => 1
                ]);
            }
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
                $Payment = Notice::find($id);
                $Payment->delete();
            }, 5);
            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}
