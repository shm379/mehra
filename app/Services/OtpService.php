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
        if ($verificationCode && $now->isBefore($verificationCode->expired_at)) {
            return $verificationCode;
        } elseif($verificationCode && $now->isAfter($verificationCode->expired_at)){
            Otp::query()->where('user_id', $user->id)->delete();
        }
        $code = rand(103246, 999999);
        $expireTime= $now->addMinutes(30);

        // Create a New OTP
        return Otp::query()->create([
            'user_id' => $user->id,
            'code' => $code,
            'expired_at' => $expireTime
        ]);
    }

    static function verifyOtp($mobile,$code)
    {
        $expireTime = now()->timezone('Asia/Tehran');
        $mobile = Helpers::mobileNumberNormalize($mobile);
        $user = User::query()->where('mobile',$mobile)->first();
        $otpGeneratedCode = Otp::query()
            ->where('user_id',$user->id)
            ->where('expired_at','>=',$expireTime);
        if(!$otpGeneratedCode->exists()){
            if($otpGeneratedCode->withTrashed()->exists()){
                return 'deleted';
            }
            return 'expired';
        } else {
            if($otpGeneratedCode->first()->code==$code){
                $otpGeneratedCode->delete();
                if(!$user->hasVerifiedMobile())
                    $user->markMobileAsVerified();

                return 'verified';
            }
        }
        return false;
    }

}
