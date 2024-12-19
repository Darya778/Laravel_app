<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    @extends('layouts.app')

    @section('content')
        <h1 class="mb-4">All Published Posts</h1>

    <!-- Сообщение об успехе -->
        @if(session('success'))
	    <div class="alert alert-success">
	        {{ session('success') }}
	    </div>
        @endif

    <!-- Кнопка для создания нового поста -->
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-4">Create New Post</a>

    <!-- Таблица с постами -->
        @if ($posts->count() > 0)
	    <table class="table table-striped">
	        <thead>
	            <tr>
    	                <th>#</th>
    	                <th>Title</th>
    	                <th>Published At</th>
    	                <th>Actions</th>
    	            </tr>
    	        </thead>
    	        <tbody>
    	            @foreach ($posts as $post)
    	                <tr>
    	                    <td>{{ $loop->iteration }}</td>
    	                    <td>{{ $post->title }}</td>
			    <td>
				@if($post->published_at)
    				    {{ \Carbon\Carbon::parse($post->published_at)->format('d M, Y') }}
				@else
    				    Not published
				@endif
			    </td>
    	                    <!--<td>{{ $post->published_at ? $post->published_at->format('d M, Y') : 'Not published' }}</td>
    	                    -->
			    <td>
                            <!-- Кнопка редактирования -->
                	        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <!-- Кнопка удаления -->
                    	        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                            	    @csrf
                            	    @method('DELETE')
                        	    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                    	        </form>

                            <!-- Кнопка публикации/снятия с публикации -->
                        	@if($post->is_published)
                            	    <form action="{{ route('posts.unpublish', $post->id) }}" method="POST" style="display:inline;">
                            	        @csrf
                            	        @method('PUT')
                                	<button type="submit" class="btn btn-secondary btn-sm">Unpublish</button>
                            	    </form>
                        	@else
                            	    <form action="{{ route('posts.publish', $post->id) }}" method="POST" style="display:inline;">
                            	        @csrf
                                	@method('PUT')
                            	        <button type="submit" class="btn btn-success btn-sm">Publish</button>
                        	    </form>
                    	        @endif
                	    </td>
            	        </tr>
        	    @endforeach
    	        </tbody>
	    </table>
        @else
            <p>No published posts found.</p>
	@endif
    @endsection





<!--
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>

    <h1>All Published Posts</h1>

    @if ($posts->count())
        <ul>
            @foreach ($posts as $post)
                <li>
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->content }}</p>
                    <small>Published at: {{ $post->published_at }}</small>
                </li>
            @endforeach
        </ul>
    @else
        <p>No published posts found.</p>
    @endif-->
</body>
</html>
