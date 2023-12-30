<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('home');
    }

    public function form()
    {
        return view('form');
    }
    public function employee()
    {
        
        return view('employee');
    }

    public function bootstrap_table()
    {
        return view('bootstrap_table');
    }

    public function sign_in()
    {
        return view('sign_in');
    }

    public function sign_up()
    {
        return view('sign_up');
    }

    public function sample_page()
    {
        return view('sample_page');
    }
}
