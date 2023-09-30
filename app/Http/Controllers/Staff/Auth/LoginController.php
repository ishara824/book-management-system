<?php

namespace App\Http\Controllers\Staff\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $guard = 'staff';

    public function __construct()
    {

    }
    public function showLoginForm()
    {
        return view('staff.login');
    }

    public function login(Request $request)
    {

        if (Auth::guard('staff')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {

            return redirect()->route('staff.dashboard');
        }

        return redirect()->back()->withErrors(['message' => 'Invalid login credentials']);
    }

    public function logout()
    {
        Auth::guard('staff')->logout();
        return redirect()->route('staff.login');
    }
}
