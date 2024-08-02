<!-- resources/views/profile_form.blade.php -->

@extends('layouts.app')

@section('content')
<!-- products.blade.php -->
<div class="container m-4">
    <h2>Products list</h2>
    <a class="btn btn-primary m-2" href="{{ route( 'product.create' ) }}">Create product</a>
    <div class="row">
        @foreach($products as $product)
            <div id="product{{ $product->id }}" class="col-md-4">
                <div class="card border-0 rounded-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Publisher:</strong> <a href="{{ route( 'profile', [ 'user' => $product->user_id ] ) }}">{{ $product->user->name }}</a></h5>
                        <h5 class="card-title"><strong>Title:</strong> {{ $product->title }}</h5>
                        <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                        <p class="card-text"><strong>Rating:</strong> {{ $product->rate }}/5</p>
                        <div class="d-flex justify-content-between">
                            <a class="m-2" href="{{ route( 'product.show', [ 'product' => $product->id ] ) }}">View</a>
                            <form action="{{ route('product.destroy', ['product' => $product->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
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