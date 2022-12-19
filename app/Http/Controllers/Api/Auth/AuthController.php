<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\Api\Auth\SendOtpException;
use App\Exceptions\MehraApiException;
use App\Helpers\Helpers;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\UpdateMeRequest;
use App\Http\Requests\Api\Auth\VerifyOtpRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\SendVerifySMS;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;
use Throwable;

class AuthController extends Controller
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

        return $this->successResponseWithData(['temporary_token'=>$temporaryToken->plainTextToken]);
    }

    public function verifyOTP(VerifyOtpRequest $request)
    {
        try {
            /** @var PersonalAccessToken personalAccessToken */
            $temporaryToken = PersonalAccessToken::findToken($request->bearerToken());
            /** @var mixed $user */
            $user = $temporaryToken->tokenable;
            if($user && OtpService::verifyOtp($user->mobile,(int)$request->get('code'))){
                $token = $user->createToken('web');
            } else {
                return $this->errorResponse('کد تایید اشتباه است');
            }
        } catch (\Exception $exception){
            return $this->errorResponse('خطایی در تایید کد پیش آمده است');
        }

        return $this->successResponseWithData([
            'token'=>$token->plainTextToken,
            'refresh_token'=>route('api.v1.refresh-token'),
            'user'=> UserResource::make($user)
        ]);
    }

    public function refreshToken(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->successResponseWithData([
            'access_token' => $request->user()->createToken('web', ['view-user'])->plainTextToken
        ]);
    }

    public function getMe(Request $request)
    {
        return $this->successResponseWithData(UserResource::make($request->user('sanctum')));
    }

    public function updateMe(UpdateMeRequest $request)
    {
        $user = $request->user('sanctum');
        try {
            $user->update($request->validated());
            if(count($user->getChanges()) > 0){
               if(in_array('mobile',array_keys($user->getChanges()))){
                   $user->markMobileAsNotVerified();
               }
               if(in_array('email',array_keys($user->getChanges()))){
                    $user->markEmailAsNotVerified();
               }
            }
            $this->uploadMedia($user,'avatar','avatar');
        } catch (MehraApiException $exception){
            return $this->errorResponse('عملیات با خطا مواجه شد!');

        }
        return $this->successResponse('اطلاعات با موفقیت ویرایش گردید');
    }
}
