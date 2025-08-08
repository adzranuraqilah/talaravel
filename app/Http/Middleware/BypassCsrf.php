<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BypassCsrf
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Bypass hanya untuk webhook Midtrans
        if ($request->is('midtrans/webhook')) {
            return $next($request);
        }

        // Middleware asli
        return app(\App\Http\Middleware\VerifyCsrfToken::class)->handle($request, $next);
    }
}
