<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use RespController;

    public function __invoke(Request $request)
    {
        // Create a new Validator instance
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Perform the validation
        if ($validator->fails()) {
            // Validation fails
            return $this->errorResponse('In correct or missing data!', 422, $validator->errors());
        }

        $user = User::query()
        ->where('email', $request->email)
        ->first();

        if (!$user) {
            return $this->errorResponse('There is no such user!', 404, null);
        }
        if (!Hash::check($request->password, $user->password)) {
            return $this->errorResponse('Wrong passowrd!', 422, null);
        }
        return $user
                ->createToken($request->email)
                ->plainTextToken;
    }
}
