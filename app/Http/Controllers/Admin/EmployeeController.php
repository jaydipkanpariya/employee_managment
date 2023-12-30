<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
class EmployeeController extends Controller
{
    public function index(){
        return view('employee.list');
    }
}
