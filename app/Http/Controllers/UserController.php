<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user          = Auth()->user();
        $currentUserId = $user->ID;
        $usersProfiles = Profile::with('withUser')->whereHas(
            'withUser',
            function ($query) use ($currentUserId) {
                $query->where('user_id', '!=', $currentUserId);
            }
        )->paginate(10);

        return view('users.index', compact('user', 'usersProfiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth()->user();
        return view('users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate(
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

        Profile::create(
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

        return redirect()->route('user.create')->with('success', 'User has been added successflly');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $profile = $user->profile;
        return view('users.show', compact('user', 'profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $profile = $user->Profile;
        return view('users.edit', compact('user', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the request data
        $validatedData = $request->validate(
            array(
                'first_name' => 'required|string',
                'last_name'  => 'nullable|string',
                'phone'      => 'nullable|string',
                'address'    => 'nullable|string',
                'age'        => 'nullable|integer',
                'bio'        => 'nullable|string',
                'gender'     => 'nullable|integer',
            )
        );

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
        return redirect()
        ->route('user.edit', array( 'user' => $user->ID ))
        ->with('success', 'User has been edited successflly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('users')->with('success', 'Tag has been deleted successfully.');
        } else {
            return redirect()->route('users')->with('error', 'Failed to delete the tag.');
        }
    }
}
