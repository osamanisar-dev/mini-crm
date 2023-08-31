<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('auth.login-form');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required|confirmed',
        ]);
        User::create($data);
        return redirect()->route('admin.index');
    }

    public function login(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];
        $user = User::find(1);
        if ($user->email == $email && Hash::check($password, $user->password)) {
            session(['user' => $user]);
            return redirect()->route('admin.index');
        } else {
            Session::flash('invalid-data', 'Invalid Credentials! Try again');
            return redirect()->route('login-form');
        }
    }

    public function index()
    {
        $employees = Employee::count();
        $companies = Company::count();
        return view('admin.admin-page', ['employees' => $employees, 'companies' => $companies]);
    }

}
