<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * show login form for admin guard
     *
     * @return void
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * login admin
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        // return $request;
        // Validate Login Data
        $request->validate([
            'email' => 'required|max:50',
            'password' => 'required',
        ]);
        // Attempt to login
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to dashboard
            session()->flash('success', 'Successully Logged in !');
            return redirect()->route('admin.dashboard');
        } else {
            // Search using username
            if (Auth::guard('admin')->attempt(['username' => $request->email, 'password' => $request->password])) {
                session()->flash('success', 'Successully Logged in !');
                return redirect()->route('admin.dashboard');
            }
            // toastr()->error('Invalid email and password');
            session()->flash('error', 'Invalid email and password');
            return redirect()->back();
        }
    }
    /**
     * logout admin guard
     *
     * @return void
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->flash('success', 'Successully Logout !');
        return redirect()->route('admin.dashboard');
    }


}
