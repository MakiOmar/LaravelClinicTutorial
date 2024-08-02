<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    use RespController;

    public function successed(Request $request)
    {
        // Your logic here
        $data = ['example' => 'data'];
        return response($data, 200);

        // Return a success response
        return $this->successResponse($data);
    }

    public function failed(Request $request)
    {
        // Your logic here

        // Return an error response
        return $this->errorResponse('An error occurred', 500);
    }
}
