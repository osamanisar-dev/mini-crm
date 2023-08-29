<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthController extends Controller
{
    public function authenticate(Request $request){
        $companies = Company::all();
        $request->validate([
            'login' => 'required',
            'password'=>'required',
        ]);
        $credentials = $request->only('login', 'password');
        if (Auth::guard('employee')->attempt(['email' => $credentials['login'], 'password' => $credentials['password']]) ||
            Auth::guard('employee')->attempt(['username' => $credentials['login'], 'password' => $credentials['password']]))
        {
            return redirect()->route('employee.dashboard',['companies'=>$companies]);
        }
        else{
            session()->flash('error','Either email/username or password is incorrect');
            return back()->withInput($request->only('email'));
        }
    }

    public function logout(){
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login');
    }
}
