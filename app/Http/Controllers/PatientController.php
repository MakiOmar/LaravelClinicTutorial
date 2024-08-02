<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return view('list-patients', array( 'user' => $user ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        return view('add-patient', array( 'user' => $user ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return User::create(
            array(
                'name'        => $request['name'],
                'username'    => 'patient_' . uniqid(),
                'email'       => $request['email'],
                'role'        => 'patient',
                'phone'       => $request['phone'] ?? null,
                'home_number' => $request['home_number'] ?? null,
                'address'     => $request['address'] ?? null,
                'password'    => Hash::make(uniqid()),
            )
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(patient $patient)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(patient $patient)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, patient $patient)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(patient $patient)
    {
    }
}
