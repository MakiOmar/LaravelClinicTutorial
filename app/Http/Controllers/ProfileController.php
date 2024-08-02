<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth()->user();
        return view('profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        // Validation rules
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:0,1',
            'bio' => 'nullable|string|max:1000',
        ]);

        // Method one
        // $profile->update($validated);

        // Method two
        $user = Auth()->user();
        $user->name = $validated['name'];
        $user->profile->first_name = $validated['first_name'];
        $user->profile->last_name = $validated['last_name'];
        $user->profile->address = $validated['address'];
        $user->profile->age = $validated['age'];
        $user->profile->bio = $validated['bio'];
        $user->profile->gender = $validated['gender'];
        $user->profile->save();
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
