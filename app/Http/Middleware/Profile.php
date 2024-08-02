<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Profile as ModelProfile;

class Profile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth()->user() ?? null;

        if (empty($user->profile)) {
            ModelProfile::create(
                array(
                    'user_id' => $user->ID,
                )
            );
        }
        return $next($request);
    }
}
