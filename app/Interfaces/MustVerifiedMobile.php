<?php
namespace App\Interfaces;

interface MustVerifiedMobile{
    public function hasVerifiedMobile();
    public function markMobileAsVerified();
    public function sendMobileVerificationNotification();
}
