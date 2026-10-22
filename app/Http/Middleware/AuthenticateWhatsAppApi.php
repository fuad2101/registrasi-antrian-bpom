<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateWhatsAppApi
{
    public function handle(Request $request, Closure $next): Response
    {
        $expectedToken = config('services.fonnte.api_token');

        if (! is_string($expectedToken) || $expectedToken === '') {
            Log::error('WhatsApp API authentication token is not configured.');

            return response()->json(['message' => 'WhatsApp API authentication is not configured.'], 503);
        }

        $providedToken = $request->bearerToken();

        if (! is_string($providedToken) || ! hash_equals($expectedToken, $providedToken)) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return $next($request);
    }
}
