<?php

namespace App\Http\Middleware;

use App\Http\Controllers\API\RespController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AccessToken;

class AuthGate
{
    use RespController;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $BearerTokenArr = explode('|', $request->bearerToken());
        if (! $request->bearerToken() || count($BearerTokenArr) == 0 || empty($BearerTokenArr)) {
            return $this->errorResponse('Error', 400, 'Wrong data!');
        }

        if (count($BearerTokenArr) == 1) {
            // auth:sanctum use sha256 to hash tokens.
            $BearerToken = hash('sha256', $BearerTokenArr[0]);
        } else {
            $BearerToken = hash('sha256', $BearerTokenArr[ count($BearerTokenArr) - 1 ]);
        }
        $access_tokens = AccessToken::where('token', $BearerToken ?? null)->first();
        if (! $access_tokens || empty($access_tokens)) {
            return $this->errorResponse('Error', 400, 'Not Authorized!');
        }
        return $next($request);
    }
}
