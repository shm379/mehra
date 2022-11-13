<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Helpers;
use App\Http\Requests\Api\SendOTPRequest;
use App\Models\User;
use Fouladgar\OTP\Exceptions\InvalidOTPTokenException;
use Fouladgar\OTP\OTPBroker as OTPService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Throwable;

class AuthController
{
    public function __construct(private OTPService $OTPService)
    {
    }

    public function checkExists(Request $request)
    {
            /** @var User $user */
            $mobile = Helpers::mobileNumberNormalize($request->get('mobile'));
            $user = User::query()->whereMobile($mobile)->exists();
            if(!$user){
                return response()->json(['message'=>'کاربر در سیستم وجود ندارد'],404);
            }
            return response()->json(['message'=>'کاربر در سیستم موجود است']);
    }

    public function sendOTP(SendOTPRequest $request)
    {
        try {
            /** @var User $user */
            $mobile = Helpers::mobileNumberNormalize($request->get('mobile'));
            $user = $this->OTPService->send($mobile);
        } catch (Throwable $ex) {
            // or prepare and return a view.
            return response()->json(['message'=>'An unexpected error occurred.'], 500);
        }

        return response()->json(['message'=>'A token has been sent to:'. $user->mobile]);
    }

    public function verifyOTPAndLogin(Request $request)
    {
        try {
            /** @var User $user */
            $mobile = Helpers::mobileNumberNormalize($request->get('mobile'));
            if($request->has('password')){
                $user = User::query()->whereMobile($mobile)->first();
                if($user && Hash::check($request->getPassword(),$user->password)){
                    Auth::guard('api')->attempt([
                        'mobile'=> $mobile,
                        'password'=> $request->get('password')
                    ]);
                    $user = Auth::guard('api')->user();
                }
            } else {
                $user = $this->OTPService->validate($mobile, $request->get('token'));
            }
            $token = $user->createToken('app');
        } catch (InvalidOTPTokenException $exception){
            return response()->json(['error'=>$exception->getMessage()],$exception->getCode());
        } catch (Throwable $ex) {
            return response()->json(['message'=>'An unexpected error occurred.'], 500);
        }

        return response()->json(['message'=>'Logged in successfully.','token'=>$token->plainTextToken]);
    }
}
