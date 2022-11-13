<?php
namespace App\Services\OTP;

use App\Helpers\Helpers;
use Fouladgar\OTP\Contracts\SMSClient;
use Fouladgar\OTP\Notifications\Messages\MessagePayload;
use Illuminate\Support\Facades\DB;
use Kavenegar;

class KavenegarClient implements SMSClient
{
    public function __construct(protected Kavenegar $SMSService)
    {

    }

    public function sendMessage(MessagePayload $payload): mixed
    {
        try {
            $receptor = Helpers::mobileNumberNormalize($payload->to());
            $token = optional(DB::table('otp_tokens')->where('mobile',$receptor)->first())->token;
            $template = "login";
            //Send null for tokens not defined in the template
            //Pass token10 and token20 as parameter 6th and 7th
            $result = $this->SMSService::VerifyLookup($receptor, $token, null, null, $template, $type = null);
            if ($result){
                return ['ok'=>true,'mobile'=>$receptor,'code'=>$token];
            }
        } catch (\Kavenegar\Exceptions\ApiException $e) {
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            echo $e->errorMessage();
        } catch (\Kavenegar\Exceptions\HttpException $e) {
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
    }
}
