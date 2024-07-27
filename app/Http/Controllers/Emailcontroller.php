<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSupport;
use App\Http\Requests\SendOtpRequest;

class Emailcontroller extends Controller
{
    public function send_otp(SendOtpRequest $request)
    {
        try {
            $validateData = $request->validated();
            $otp = rand(1000, 9999);
            $subject = "TOT OTP Verification";
            $mail_message = "Welcome to the Tale of Tails Universe!";

            // Check if an OTP already exists for the email
            $otpRecord = Otp::where('email', $validateData['email'])->first();

            if ($otpRecord) {
                // Update existing OTP and timestamp
                $otpRecord->update([
                    'otp' => $otp,
                    'updated_at' => now(),
                ]);
            } else {
                // Create new OTP record
                Otp::create([
                    'email' => $validateData['email'],
                    'otp' => $otp,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

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
                message: 'Otp not sent!',
                statusCode: 400,
                status: 'failure',
            );
        }
    }
}
