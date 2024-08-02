<!-- resources/views/profile_form.blade.php -->

@extends('layouts.app')

@section('content')
<!-- Tags.blade.php -->
<div class="container m-4">
    <a class="btn btn-primary" href="{{ route( 'tag.create' ) }}">Create tag</a>
    <h2>Tags list</h2>
    <!-- resources/views/tags.blade.php -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Content</th>
                <th>Products</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->content }}</td>
                    <td>{{ count( $tag->products ) }}</td>
                    <td>{{ $tag->created_at }}</td>
                    <td>
                        <form action="{{ route('tag.destroy', ['tag' => $tag->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tag?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
</div>

@endsection