<?php
namespace App\Interfaces;

interface MustVerifiedMobileInterface{
    public function hasVerifiedMobile();
    public function markMobileAsVerified();
    public function sendMobileVerificationNotification($code);
}
