<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmpComController extends Controller
{
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
