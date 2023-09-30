<?php

namespace App\Http\Controllers\Reader\Auth;

use App\Http\Controllers\Controller;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    protected $guard = 'reader';

    public function __construct()
    {

    }
    public function showLoginForm()
    {
        return view('reader.login');
    }

    public function login(Request $request)
    {

        if (Auth::guard('reader')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {

            return redirect()->route('reader.dashboard');
        }

        return redirect()->back()->withErrors(['message' => 'Invalid login credentials']);
    }

    public function logout()
    {
        Auth::guard('reader')->logout();
        return redirect()->route('reader.login');
    }

    public function showRegistrationForm()
    {
        return view('reader.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'same:password'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }

        $reader = new Reader();
        $reader->first_name = $request->first_name;
        $reader->last_name = $request->last_name;
        $reader->phone_number = $request->phone_number;
        $reader->email = $request->email;
        $reader->password = Hash::make($request->password);
        $reader->save();

        return redirect()->route('reader.login');
    }

}
