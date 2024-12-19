@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
        </div>
        
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="4" required>{{ old('content', $post->content) }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="published_at">Publish Date</label>
	    <input type="datetime-local" class="form-control" id="published_at" name="published_at" 
    		value="{{ old('published_at', $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('Y-m-d\TH:i') : '') }}">
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Update Post</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back to All Posts</a>
    </form>
@endsection
