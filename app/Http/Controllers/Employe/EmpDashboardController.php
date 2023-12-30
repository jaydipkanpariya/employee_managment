<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpDashboardController extends Controller
{
    public function dashboard() {
        if (!Auth::guard('employe')->user()) {
            return view('employe.login');
        }
        return view('employe.dashboard');
    }
}
