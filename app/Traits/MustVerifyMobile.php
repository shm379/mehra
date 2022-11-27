<?php
namespace App\Traits;

use App\Helpers\Helpers;
use App\Notifications\SendVerifySMS;

trait MustVerifyMobile {
    public function hasVerifiedMobile(): bool
    {
        return ! is_null($this->mobile_verified_at);
    }

    public function markMobileAsVerified(): bool
    {
        return $this->forceFill([
            'mobile_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function sendMobileVerificationNotification($code): void
    {
        $mobile = Helpers::mobileNumberNormalize($this->mobile);
        $this->notify(new SendVerifySMS($code));
    }
}
