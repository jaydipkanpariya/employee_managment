<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Providers\EmployesServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class EmpLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = EmployesServiceProvider::EMPLOYE_DASHBOARD;


    // public function register(Request $request)
    // {
    //     // return $request;
    //     $validatedData = $request->validate([
    //         'firstname' => 'required',
    //         'lastname' => 'required',
    //         'phone' => 'required|numeric|digits:10',
    //         'email' => 'required|email',
    //         'password' => 'required|min:6',
    //     ]);

    //     $user = new Visitor;
    //     $user->f_name = $request->input('firstname');
    //     $user->l_name = $request->input('lastname');
    //     $user->mobile = $request->input('phone');
    //     $user->email = $request->input('email');
    //     $user->password = bcrypt($request->input('password'));
    //     $user->city = $request->input('city');
    //     $user->state = $request->input('state');
    //     $user->country = $request->input('country');
    //     $user->pincode = $request->input('pincode');
    //     $user->save();
    //     return redirect()->route('frontend')->with('success', 'Sign Up was successful!');
    // }
    public function showLoginForm()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|max:50',
            'password' => 'required',
        ]);

        // Attempt to login
        if (Auth::guard('employe')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('frontend')->with('success', 'Successully Logged in');
        } else {
            return redirect()->route('frontend')->with('error', 'Invalid email and password');
        }
    }
    public function logout()
    {
        Auth::guard('employe')->logout();
        return redirect()->route('frontend')->with('success', 'Logout Successully !');
    }
}
