<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            array(
                'username'    => array( 'required', 'string', 'max:255', 'unique:users' ),
                'name'        => array( 'required', 'string', 'max:255' ),
                'email'       => array( 'required', 'string', 'email', 'max:255', 'unique:users' ),
                'password'    => array( 'required', 'string', 'min:8', 'confirmed' ),
                'role'        => array(
                    'required',
                    'string',
                    function ($attribute, $value, $fail) {
                        if (! in_array($value, array( 'doctor', 'patient' ))) {
                            $fail('The ' . $attribute . ' must be either "doctor" or "patient".');
                        }
                    },
                ),
                'phone'       => array( 'sometimes', 'nullable', 'string' ),
                'home_number' => array( 'sometimes', 'nullable', 'string' ),
                'address'     => array( 'sometimes', 'nullable', 'string' ),
            )
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create(
            array(
                'name'        => $data['name'],
                'username'    => $data['username'],
                'email'       => $data['email'],
                'role'        => $data['role'],
                'phone'       => $data['phone'] ?? null,
                'home_number' => $data['home_number'] ?? null,
                'address'     => $data['address'] ?? null,
                'password'    => Hash::make($data['password']),
            )
        );
    }
}
