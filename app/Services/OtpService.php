<?php

namespace App\Services;

class OtpService
{
    public function generateOtp()
    {
        return mt_rand(100000, 999999);
    }
}
