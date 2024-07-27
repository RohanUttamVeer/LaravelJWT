<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Requests\VerifyOtpRequest;
use App\Models\Otp;
use Illuminate\Http\Request;

class VerifyOtpController extends Controller
{
    public function verify_otp(VerifyOtpRequest $request)
    {
        try {
            $validateData = $request->validated();

            $otpRecord = Otp::where('email', $validateData['email'])
                ->where('otp', $validateData['otp'])
                ->first();

            if ($otpRecord && $otpRecord->updated_at->diffInMinutes(now()) <= 10) {
                return ResponseHelper::success(
                    message: 'OTP verified successfully!',
                    data: null,
                    statusCode: 200,
                    status: 'success',
                );
            }

            return ResponseHelper::error(
                message: 'Invalid or expired OTP!',
                statusCode: 400,
                status: 'failure',
            );
        } catch (\Exception $e) {
            \Log::error('Otp exception error : ' . $e->getMessage() . 'Line number : ' . $e->getLine());
            return ResponseHelper::error(
                message: 'Invalid or expired OTP',
                statusCode: 400,
                status: 'failure',
            );
        }
    }
}
