<?php

namespace App\Services;

use App\Helpers\Helpers;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;

class OtpService
{
    static function isMobileValid($number)
    {
        return !is_null(User::query()->where('mobile', $number)->first());
    }

    static function generateOtp($mobile)
    {
        $mobile = Helpers::mobileNumberNormalize($mobile);
        $user = User::query()->where('mobile', $mobile)->first();

        # User Does not Have Any Existing OTP
        $verificationCode = Otp::query()->where('user_id', $user->id)->latest()->first();

        $now = Carbon::now();
        $expireTime= $now->addMinutes(30);

        if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
            return $verificationCode;
        }

        $code = rand(103246, 999999);

        // Create a New OTP
        return Otp::query()->create([
            'user_id' => $user->id,
            'code' => $code,
            'expired_at' => $expireTime
        ]);
    }

    static function verifyOtp($mobile,$code)
    {
        $expireTime = now()->addMinutes(30);
        $mobile = Helpers::mobileNumberNormalize($mobile);
        $user = User::query()->where('mobile',$mobile)->first();
        $otpGeneratedCode = Otp::query()
            ->where('user_id',$user->id)
            ->where('expired_at','>',$expireTime);
        if(!$otpGeneratedCode->exists()){
            return false;
        } else {
            if($otpGeneratedCode->first()->code==$code){
                $otpGeneratedCode->delete();
                if(!$user->hasVerifiedMobile())
                    $user->markMobileAsVerified();

                return true;
            }
        }
        return false;
    }

}
