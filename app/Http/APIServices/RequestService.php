<?php

namespace App\Http\APIServices;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RequestService
{
    public function apiRequest($url)
    {
        try {
            $response = Http::get($url);

            return $response;

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}