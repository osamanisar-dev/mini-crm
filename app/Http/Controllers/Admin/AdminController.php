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
//        $file = public_path().'/storage/uploads/2.png';
//        $headers = array(
//            'Content-Type: application/png',
//        );
//        return response()->download($file, 'filename.pdf', $headers);
        return view('admin.admin-page',['employees'=>$employees,'companies'=>$companies]);
    }

}
