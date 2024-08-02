<!-- resources/views/profile_form.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All users</h1>
    @include( 'layouts.error-messages' )
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($usersProfiles as $profile)
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">First Name</h5>
                        <p class="card-text">{{ $profile->first_name ?? 'Not set.' }}</p>
                        
                        <h5 class="card-title">Last Name</h5>
                        <p class="card-text">{{ $profile->last_name ?? 'Not set.' }}</p>
                        
                        <h5 class="card-title">Address</h5>
                        <p class="card-text">{{ $profile->address ?? 'Not set.' }}</p>
                        
                        <h5 class="card-title">Age</h5>
                        <p class="card-text">{{ $profile->age ?? 'Not set.' }}</p>
                        
                        <h5 class="card-title">Gender</h5>
                        <p class="card-text">
                            @if($profile->gender === 0)
                                Female
                            @elseif($profile->gender === 1)
                                Male
                            @else
                                Not set
                            @endif
                        </p>
                        
                        <h5 class="card-title">Bio</h5>
                        <p class="card-text">{{ $profile->bio }}</p>
                        <div class="d-flex justify-content-between">
                            <span>
                                <a href="{{ route( 'user.show', [ 'user' => $profile->user_id ] ) }}">View</a> | 
                                <a href="{{ route( 'user.edit', [ 'user' => $profile->user_id ] ) }}">Edit</a>
                            </span>
                            <form action="{{ route('user.destroy', ['user' => $profile->user_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Users?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection