<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse;
use Inertia\Inertia;

class CustomRegisterResponse implements RegisterResponse
{
    public function toResponse($request)
    {
        return Inertia::location('/console');
    }
}
