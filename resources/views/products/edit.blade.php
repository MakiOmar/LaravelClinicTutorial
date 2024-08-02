@extends('layouts.app')

@section('content')

<!-- add-product.blade.php -->
<div class="container my-5">
    <a class="btn btn-primary m-2" href="{{ route( 'product' ) }}">Back</a>
    <h2>Edit Product</h2>
    @include( 'layouts.error-messages' )
    <form action="{{ route('product.update', [ 'product' => $product->id ]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Product Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $product->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Product Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $product->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $product->price }}" required>
        </div>
        <div class="mb-3">
            <label for="rate" class="form-label">Rating</label>
            <input type="number" class="form-control" id="rate" name="rate" min="1" max="5" value="{{ $product->rate }}" required>
        </div>

        <div class="mb-3">
            <select class="form-select multiple" multiple name="tag_id[]">
                <option value="">Select Tag</option>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" @if(in_array( $tag->id, $product->tags->pluck('id')->toArray() ) ) selected @endif>{{ $tag->content }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>


@endsection