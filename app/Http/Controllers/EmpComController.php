<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class EmpComController extends Controller
{

    public function loginApi(Request $request){
        $email = $request['email'];
        $password = $request['password'];
        $user = User::find(1);
        if ($user->email == $email && Hash::check($password, $user->password)){
            $token = $user->createToken('auth_token')->accessToken;
            return response()->json([
               'token'=>$token,
               'status'=>'success',
                'user'=>$user,
                'message'=>"User Authorized",
            ]);
        }
        else{
            return response()->json([
                'status'=>0,
                'message'=>"User Not Authorized",
            ]);
        }
    }



    public function getData(){
        $employees = Employee::all();

        $employeeData = $employees->map(function($employee){
            return[
                'id'=>$employee->id,
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'companies' => $employee->companies->toArray()
            ];
        });
        return response()->json($employeeData, 200);


    }
}
