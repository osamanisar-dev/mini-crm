<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    public function create(){
        $companies = Company::all();
        return view('employee.create',['companies'=>$companies]);
    }

    public function store(Request $request){
        $employee = new Employee();
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'username'=>['required','unique:employees'],
            'email'=>['required','email','unique:employees'],
            'password'=>['required','confirmed'],
            'company_id'=>'required',
        ]);
        $employee->first_name = $request['first_name'];
        $employee->last_name = $request['last_name'];
        $employee->username = $request['username'];
        $employee->email = $request['email'];
        $employee->password = bcrypt($request['password']);
        $employee->save();

        foreach($request->company_id as $company){
            $com_company = Company::find($company);
            $employee->companies()->attach($com_company);
        }
        $details = [
            'title' => 'Your account has been created in MINI-CRM',
            'body' => 'Success'
        ];
        \Mail::to($employee->email)->send(new \App\Mail\MyTestMail($details));
        return redirect()->route('employee.view');
    }

    public function view(){
        $employees = Employee::paginate(10);
        return view('employee.view',['employees'=>$employees]);
    }

    public function destroy(Request $request){
        $emp_id = $request['delete_company_id'];
        $employee = Employee::find($emp_id);
        $employee->delete();
        Session::flash('message', 'Employee '.$employee->first_name.' has Deleted Successfully');
        return back();
    }

    public function edit(Employee $employee){
        $companies = Company::all();
        return view('employee.edit',['employee'=>$employee,'companies'=>$companies]);
    }
    public function update(Request $request, Employee $employee){
//        dd($request->all(),$employee);
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'username'=>'required|unique:employees,username,'.$employee->id,
            'email'=>'required|unique:employees,email,'.$employee->id,
        ]);

        $employee->companies()->detach();
        $employee->first_name = $request['first_name'];
        $employee->last_name = $request['last_name'];
        $employee->username = $request['username'];
        $employee->email = $request['email'];
        $employee->save();

        if($request->company_id){
            foreach($request->company_id as $company){
                $com_company = Company::find($company);
                $employee->companies()->attach($com_company);
            }
        }

        return redirect()->route('employee.view');
    }
}
