<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\RespController;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    use RespController;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $profile       = new Profile();
        $fillables     = $profile->getFillable();
        $perPage       = $request->query('per_page', 10);
        $usersProfiles = Profile::paginate($perPage)->appends(request()->query());
        $columnValues  = array();
        if ($usersProfiles && count($usersProfiles) > 0) {
            foreach ($usersProfiles as $row) {
                $temp = array();
                foreach ($fillables as $column) {
                    $temp[ $column ] = $row->$column;
                }
                $columnValues[] = $temp;
            }
        }
        return $this->successResponse($columnValues, 'Success', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make(
            $request->all(),
            array(
                'first_name'  => 'required|string',
                'last_name'   => 'nullable|string',
                'email'       => 'required|email|unique:users,email',
                'phone'       => 'nullable|string',
                'home_number' => 'nullable|string',
                'address'     => 'nullable|string',
                'age'         => 'nullable|integer',
                'bio'         => 'nullable|string',
                'gender'      => 'nullable|integer',
            )
        );
        // Perform the validation
        if ($validator->fails()) {
            // Validation fails
            return $this->errorResponse('In correct or missing data!', 422, $validator->errors());
        }

        $user = User::create(
            array(
                'name'        => $request['first_name'] . ' ' . $request['last_name'] ?? '',
                'username'    => 'user_' . uniqid(),
                'email'       => $request['email'],
                'role'        => 'patient',
                'phone'       => $request['phone'] ?? null,
                'home_number' => $request['home_number'] ?? null,
                'address'     => $request['address'] ?? null,
                'password'    => Hash::make(uniqid()),
            )
        );
        if ($user) {
            $userProfile = Profile::create(
                array(
                    'user_id'    => $user->ID,
                    'first_name' => $request['first_name'] ?? null,
                    'last_name'  => $request['last_name'] ?? null,
                    'address'    => $request['address'] ?? null,
                    'age'        => $request['age'] ?? null,
                    'bio'        => $request['bio'] ?? null,
                    'gender'     => $request['gender'] ?? 1,
                )
            );
            return $this->successResponse($userProfile, 'User has been added successflly', 200);
        } else {
            return $this->errorResponse('Error', 400, 'User can not be created!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $profile = $user->profile;
        if ($profile) {
            return $this->successResponse($profile, 'success', 200);
        } else {
            return $this->errorResponse('Error', 404, 'Not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the request data
        $validator = Validator::make(
            $request->all(),
            array(
                'first_name'  => 'required|string',
                'last_name'   => 'nullable|string',
                'email'       => 'required|email',
                'phone'       => 'nullable|string',
                'home_number' => 'nullable|string',
                'address'     => 'nullable|string',
                'age'         => 'nullable|integer',
                'bio'         => 'nullable|string',
                'gender'      => 'nullable|integer',
            )
        );
        // Perform the validation
        if ($validator->fails()) {
            // Validation fails
            return $this->errorResponse('In correct or missing data!', 422, $validator->errors());
        }

        $user->name  = $request['first_name'] . ' ' . $request['last_name'] ?? '';
        $user->phone = $request['phone'] ?? null;
        $user->save();
        $user->profile->first_name = $request['first_name'];
        $user->profile->last_name  = $request['last_name'] ?? null;
        $user->profile->address    = $request['address'] ?? null;
        $user->profile->age        = $request['age'] ?? null;
        $user->profile->bio        = $request['bio'] ?? null;
        $user->profile->gender     = $request['gender'] ?? 1;
        $user->profile->save();
        return $this->successResponse($user->ID, 'User has been edited successflly', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return $this->successResponse('Success', 'User has been edited successflly', 200);
        } else {
            return redirect()->route('users')->with('error', 'Failed to delete the user.');
            return $this->errorResponse('Failed to delete the user.', 422, 'failed');
        }
    }
}
