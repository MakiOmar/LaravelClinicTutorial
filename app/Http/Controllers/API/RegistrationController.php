<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    use RespController;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        // Create a new Validator instance
        $validator = Validator::make(
            $request->all(),
            array(
                'name'     => array( 'required' ),
                'email'    => array(
                    'required',
                    'email',
                    'unique:users,email',
                ),
                'password' => array(
                    'required',
                    'min:8',
                    'confirmed',
                ),
            )
        );

        // Perform the validation
        if ($validator->fails()) {
            // Validation fails
            return $this->errorResponse('In correct or missing data!', 422, $validator->errors());
        }

        $user = User::create(
            array(
                'name'     => request('name'),
                'email'    => request('email'),
                'username' => request('email'),
                'role'     => request('role'),
                'password' => Hash::make(request('password')),
            )
        );

        return $user
                ->createToken(request('email'))
                ->plainTextToken;
    }
}
