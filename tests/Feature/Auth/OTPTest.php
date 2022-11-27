<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class OTPTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    public function test_cannot_login_with_invalid_mobile()
    {
        $response = $this->post(route('send-otp'),[
            'mobile'=> '893891y89289198'
        ]);
        if($response->status()==500){
            $this->assertTrue(true);
        } else {
            $this->assertFalse(true);
        }
    }
    public function test_can_login_with_existing_mobile()
    {
        $response = $this->post(route('send-otp'),[
            'mobile'=> '+989391727950'
        ]);
        if($response->status()==200){
            $this->assertTrue(true);
        } else {
            $this->assertFalse(true);
        }

    }

    public function test_cannot_verify_mobile_with_invalid_code()
    {
        $response = $this->post(route('send-otp'),[
            'mobile'=> '+989391727950'
        ]);
        $token = $response->collect('temporary_token')->first();
        $response =
            $this
                ->withHeader('Authorization', 'Bearer ' . $token)
                ->post(route('verify-otp'),[
                    'code'=> '899as88'
                ]);
        if($response->status()!==200){
            $this->assertTrue(true);
        } else {
            $this->assertFalse(true);
        }
    }

    public function test_can_verify_mobile_with_success_code()
    {
        $mobile = '+989391727950';
        $response = $this->post(route('send-otp'),[
            'mobile'=> $mobile
        ]);

        $user = User::query()->where('mobile',$mobile)->first();
        $token = $response->collect('temporary_token')->first();
        $otp_code = (string)Otp::query()->first()->code;
        $response = $this
                ->withHeader('Authorization', 'Bearer ' . $token)
                ->post(route('verify-otp'),[
                    'code'=>$otp_code
                ]);
        $this->assertTrue($response->status()==200);
        $this->assertFalse($response->status()!=200);

    }

}
