<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Support\Facades\Hash;

class GeneratePasswordService
{

    /**
     * Get hashed password with salt
     */
    public static function getPassword(string $password): string
    {
        $hashpassword = Hash::make($password);
        return $hashpassword;
    }
}
