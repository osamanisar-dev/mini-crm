<?php

namespace App\Http\Controllers\MailOTP;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Otp;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class OtpPasswordResetController extends Controller
{
    public function showResetOtpForm(){
        return view('employeesec.passwords.email');
    }

    public function sendOtp(Request $request, OtpService $otpService){
        $request->validate([
            'email'=>['required','email']
        ]);
        $email = $request->input('email');
        $employee = Employee::where('email', $email)->first();

        if ($employee) {
            $otp = $otpService->generateOtp();

            $new_otp = new Otp();
            $new_otp->employee_id = $employee->id;
            $new_otp->opt = $otp;
            $new_otp->save();

                $otpmail = [
                    'title' => 'Your OTP code is '.$new_otp->opt,
                    'body' => 'Success'
                ];
                \Mail::to($email)->send(new \App\Mail\OtpMail($otpmail));

            Session::flash('otp-send-success', 'OTP has send to your mail');
            return view('employeesec.passwords.otpform',['employee'=>$employee]);
        } else {
            return redirect()->back()->withErrors(['email' => 'User not found']);
        }
    }

    public function resetWithOtp(Request $request){
        {
//            dd(123);
            $messages = [
                'otp.digits' => 'The OTP must be exactly :digits digits.',
            ];
//            $request->validate([
//                'email' => ['required','email'],
//                'otp' => ['required','numeric','digits:6'],
//                'password' => ['required','confirmed','min:8'],
//            ], ['otp.digits' => 'The OTP must be exactly :digits digits.',]);
            $email = $request->input('email');
            $otp = $request->input('otp');
            $password = $request->input('password');

            $employee = Employee::where('email', $email)->first();

            $otpData = Otp::where('employee_id', $employee->id)->orderByDesc('created_at')->first();

            if ($otpData && $otpData->opt == $otp) {
                Employee::where('email', $email)->update([
                    'password' => Hash::make($password),
                ]);
                // Delete the used OTP
                Otp::where('id', $otpData->id)->delete();

                Session::flash('password-reset-success', 'Password Reset Successfully');
                return view('employeesec.login');
            } else {
                Session::flash('invalid-otp', 'Invalid OTP, Please try Again!');
                return view('employeesec.passwords.otpform',['employee'=>$employee]);
            }
        }
    }

}
