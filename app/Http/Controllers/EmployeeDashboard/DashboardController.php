<?php

namespace App\Http\Controllers\EmployeeDashboard;

use App\Events\PusherBroadcast;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('employeesec.dashboard');
    }

    public function profile()
    {
        $companies = Company::all();
        return view('employeesec.profile', ['companies' => $companies]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);

        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->username = $request['username'];
        $user->email = $request['email'];

        $user->save();
        Session::flash('profile-update', 'Profile Updated Successfully');
        return redirect()->route('employee.dashboard');
    }

    public function message($id)
    {
        $admin = User::find(1);
        $emp_id = Auth::user()->id;
        $messages = Message::where('employee_id', $emp_id)->get();
        return view('employeesec.chats.message', ['messages' => $messages, 'admin' => $admin]);
    }

    public function broadcast(Request $request)
    {
        $employee = Employee::where('id', $request->employee_id)->first();
        $employee_name = $employee->first_name;
        $msg = Message::all()->pluck('message');
        $message = new Message();

        broadcast(new PusherBroadcast($request->get('message'), $request->get('employee_id'), $employee_name))->toOthers();

        $message->employee_id = Auth::user()->id;
        $message->user_id = $request['admin_id'];
        $message->message = $request['message'];
        $message->sender_type = 'user';
        $message->save();

        $data = [
            'status' => 'success',
            'talk' => 'Message sent successfully',
            'message' => $message,
            'msg' => $msg,
            'employee_name' => $employee_name,
        ];
        return response()->json($data);
    }

    public function receive(Request $request)
    {
        return view('receive', ['message' => $request->get('message')]);
    }

}
