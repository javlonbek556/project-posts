@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Create New Post</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter post name" >
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Body</label>
                        <textarea class="form-control" id="title" name="title" rows="3" placeholder="Enter post title" ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image" >
                    </div>
                    <button type="submit" class="btn btn-primary">Add Post</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
