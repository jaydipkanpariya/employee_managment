<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard() {

        return '123';

        if (!Auth::guard('admin')->user()) {
            return view('admin.login');
        } 
    }
}
