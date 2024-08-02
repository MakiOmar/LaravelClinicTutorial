<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Logout class
 */
class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param object $request Request object.
     *
     * @return void
     */
    public function __invoke(Request $request)
    {
        return request()
            ->user()
            ->currentAccessToken()
            ->delete();
    }
}
