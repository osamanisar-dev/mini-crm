<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(){
        $employees = Employee::count();
        $companies = Company::count();
        return view('admin.admin-page',['employees'=>$employees,'companies'=>$companies]);
    }

}
