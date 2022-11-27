<?php

namespace App\Notifications;

use App\Exceptions\InvalidOTPTokenException;
use App\Helpers\Helpers;
use App\Models\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use \Kavenegar\Laravel\Channel\KavenegarChannel;
use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;

class SendVerifySMS extends KavenegarBaseNotification
{
    public $code;
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return KavenegarMessage
     */
    public function toKavenegar($notifiable)
    {
        $mobile = Helpers::mobileNumberNormalize($notifiable->mobile);
        return (new KavenegarMessage())
                ->verifyLookup('login',[$this->code]);
    }
}
