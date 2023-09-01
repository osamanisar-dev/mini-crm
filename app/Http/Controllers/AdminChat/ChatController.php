<?php

namespace App\Http\Controllers\AdminChat;

use App\Events\PusherBroadcast;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Message;
use App\Notifications\MessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function viewallemp()
    {
        $sortedEmployees = Employee::all();
        return view('adminchats.showuser', ['sortedEmployees' => $sortedEmployees]);
    }

    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }


    public function employeechat(Request $request, Employee $employee)
    {
        $messages = Message::where('employee_id', $employee->id)->get();
        return view('adminchats.selecteduser', ['employee' => $employee, 'messages' => $messages]);
    }

    public function broadcast(Request $request)
    {
        $employee = Employee::where('id', $request['employee_id'])->first();
        $employee_name = $employee->first_name;

        $msg = Message::all()->pluck('message');
        $message = new Message();

        broadcast(new PusherBroadcast($request->get('message'), $request->get('employee_id'), $employee_name))->toOthers();

        $message->employee_id = $request['employee_id'];
        $message->user_id = session('user')->id;
        $message->message = $request['message'];
        $message->sender_type = 'admin';
        $message->save();

        $data = [
            'status' => 'success',
            'talk' => 'Message sent successfully',
            'message' => $message,
            'msg' => $msg,
        ];
        return response()->json($data);
    }

    public function receive(Request $request)
    {
        $message = $request['message'];
        $employee_id = $request['employee_id'];
        return view('receive', ['message' => $message, 'employee_id' => $employee_id]);
    }

    public function filter(Request $request)
    {
        $employees = Employee::all();
        $filter = $request->filter;
        if ($filter === 'latest') {
            $sortedEmployees = $employees->sortByDesc(function ($employee) {
                $latestMessage = $employee->message()->latest('created_at')->first();
                return $latestMessage ? $latestMessage->created_at : null;
            });
            return view('adminchats.showuser', ['sortedEmployees' => $sortedEmployees, 'filter' => $filter]);
        } else {
            return view('adminchats.showuser', ['sortedEmployees' => $employees, 'filter' => $filter]);
        }
    }

    public function notificationTesting(Request $request)
    {
        $employee_id = $request['employee_id'];
        $employee = Employee::where('id', $employee_id)->first();
        $message = $request['message'];
        Auth::user()->notify(new MessageNotification($employee, $message));
        $data = [
            'status' => 'success',
            'count' => Auth::user()->unreadNotifications->count(),
            'admin_id' => $request['admin_id']
        ];
        return response()->json($data);
        dd("done");
    }
}
