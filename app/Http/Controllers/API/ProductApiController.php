<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\API\RespController;

class ProductApiController extends Controller
{
    use RespController;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method one
        $user     = Auth()->user();
        $products = $user->products;

        return $this->successResponse($user, 'Success', 200);
    }
}
