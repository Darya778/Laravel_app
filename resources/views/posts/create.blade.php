<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Create a New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label><br>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="content">Content:</label><br>
            <textarea name="content" id="content" rows="5" required></textarea>
        </div>

        <div>
            <label for="published_at">Publish Date:</label><br>
            <input type="datetime-local" name="published_at" id="published_at" required>
        </div>

        <button type="submit">Create Post</button>
    </form>

    <a href="{{ route('posts.index') }}">Back to Posts</a>
</body>
</html>
