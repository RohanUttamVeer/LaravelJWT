<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSupport;
use App\Http\Requests\SendOtpRequest;

class Emailcontroller extends Controller
{
    public function send_otp(SendOtpRequest $request)
    {
        try {
            $validateData = $request->validated();
            $subject = "TOT OTP Verification";
            $mail_message = "Welcome to the Tale of Tails Universe!";
            $otp = rand(1000, 9999);
            // $otp = substr(str_shuffle("0123456789"), 0, 4);
            Mail::to($validateData['email'])->send(
                new EmailSupport(
                    $subject,
                    $mail_message,
                    $otp,
                )
            );

            return ResponseHelper::success(
                message: 'Otp sent successfully!',
                data: $otp,
                statusCode: 200,
                status: 'success',
            );
        } catch (\Exception $e) {
            \Log::error('Otp exception error : ' . $e->getMessage() . 'Line number : ' . $e->getLine());
            return ResponseHelper::error(
                message: 'User not sent!',
                statusCode: 400,
                status: 'failure',
            );
        }
    }
}
