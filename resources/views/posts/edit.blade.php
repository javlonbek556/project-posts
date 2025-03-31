@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Edit Post</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ $post->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Body</label>
                        <textarea class="form-control" id="title" name="title" rows="3" required>{{ $post->title }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        
                        @if (!empty($post->image)) {{-- Rasm mavjudligini tekshiramiz --}}
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" width="200" class="img-thumbnail">
                            </div>
                        @else
                            <p class="text-muted mt-2">No image available</p>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-warning">Update Post</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
