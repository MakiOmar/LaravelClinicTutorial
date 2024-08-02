@extends('layouts.app')

@section('content')

<!-- add-product.blade.php -->
<div class="container my-5">
    <a class="btn btn-primary m-2" href="{{ route( 'tags' ) }}">Back</a>
    <h2>Add New Product</h2>
    @include( 'layouts.error-messages' )
    <form action="{{ route('tag.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <input type="text" class="form-control" id="content" name="content" value="{{ old( 'content' ) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Tag</button>
    </form>
</div>


@endsection