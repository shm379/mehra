<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\Api\Auth\SendOtpException;
use App\Helpers\Helpers;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\VerifyOtpRequest;
use App\Models\User;
use App\Notifications\SendVerifySMS;
use App\Services\OtpService;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;
use Throwable;

class AuthController
{

    public function checkExists($mobile)
    {
         /** @var User $user */
         $mobile_normalized = Helpers::mobileNumberNormalize($mobile);
         $user = User::query()->where('mobile',$mobile_normalized);
         if(!$user->exists()){
             return false;
         }
         return $user->first();
    }

    public function registerUser($mobile)
    {
        return User::query()->create([
            'mobile'=> $mobile
        ]);
    }

    public function sendOTP(LoginRequest $request)
    {
        try {
            /** @var  $user User */
            $mobile = Helpers::mobileNumberNormalize($request->get('mobile'));

            $user = $this->checkExists($mobile);
            if(!$user){
                $user = $this->registerUser($mobile);
            }
            $code = \App\Services\OtpService::generateOtp($mobile);
            if(config('app.env')=='production') {
                if($code)
                    $user->sendMobileVerificationNotification($code->code);
            }
            // generate token
            $temporaryToken = $user->createToken('web',['verify-otp']);

        } catch (SendOtpException $ex){}

        return response()->json(['success'=>true,'temporary_token'=>$temporaryToken->plainTextToken]);
    }

    public function verifyOTP(VerifyOtpRequest $request)
    {
        try {
            /** @var PersonalAccessToken personalAccessToken */
            $temporaryToken = PersonalAccessToken::findToken($request->bearerToken());
            /** @var mixed $user */
            $user = $temporaryToken->tokenable;
            if($user && OtpService::verifyOtp($user->mobile,(int)$request->get('code'))){
                $token = $user->createToken('web',['view-user']);
            } else {
                return response()->json(['success'=>false,'message'=>'کد تایید اشتباه است']);
            }
        } catch (\App\Exceptions\InvalidOTPTokenException $exception){
            return response()->json(['error'=>$exception->getMessage()],$exception->getCode());
        } catch (Throwable $ex) {
            return response()->json(['success'=>false,'message'=>'خطایی در تایید کد پیش آمده است']);
        }

        return response()->json(['success'=>true,'token'=>$token->plainTextToken,'refresh_token'=>route('api.v1.refresh-token'),'user'=>$user]);
    }

    public function refreshToken(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success'=>true,
            'access_token' => $request->user()->createToken('web', ['view-user'])->plainTextToken,
        ]);
    }
}
