<?php

namespace App\Http\Middleware;

use App\Interfaces\MustVerifiedMobile;
use App\Traits\ApiResponse;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class MobileIsVerified
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user() ||
            (! $request->user()->hasVerifiedMobile())) {
            return $this->errorResponse('لطفا شماره موبایل خود را تایید کنید');
        }

        return $next($request);
    }
}
