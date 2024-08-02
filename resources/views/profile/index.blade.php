<!-- resources/views/profile_form.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>You have ({{ count($user->products) }}) products</h1>
        </div>
        <div class="col">
            <a href="{{ route( 'product' ) }}" class="btn btn-primary">View Products</a>
        </div>
    </div>
    <h2>Create Profile</h2>
    @include( 'layouts.error-messages' )
    <form action="" method="POST">
        @csrf

        @method('PUT')
        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="first_name" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <!-- First Name -->
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->profile->first_name }}" required>
        </div>
        
        <!-- Last Name -->
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->profile->last_name }}" required>
        </div>
        
        <!-- Address -->
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $user->profile->address }}" required>
        </div>
        
        <!-- Age -->
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" value="{{ $user->profile->age }}" required>
        </div>
        
        <!-- Gender -->
        <div class="mb-3">
            <label class="form-label">Gender</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_male" name="gender" value="1" @checked( old( 'gender', $user->profile->gender ?? '' ) == 1 ) required>
                    <label class="form-check-label" for="gender_male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_female" name="gender" value="0" @checked( old( 'gender', $user->profile->gender ?? '' ) == 0 ) required>
                    <label class="form-check-label" for="gender_female">Female</label>
                </div>
            </div>
        </div>
        
        <!-- Bio -->
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea class="form-control" id="bio" name="bio" rows="3" required>{{ $user->profile->bio }}</textarea>
        </div>
        
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection