<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        //
    }

    public function index()
    {
        $posts = Post::where('is_published', true)->get();
	foreach ($posts as $post) {
    	    if ($post->published_at) {
        	$post->published_at = Carbon::parse($post->published_at);
    	    }
	}
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

	Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'is_published' => true, // Не опубликован по умолчанию
            'published_at' => $data['published_at'],
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');

        //Post::create($data);

        //return redirect()->route('posts.index');
    }


    public function edit($id)
    {
	$post = Post::findOrFail($id);
	return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
	$post = Post::findOrFail($id);

	$request->validate([
    	    'title' => 'required|string|max:255',
    	    'content' => 'required|string',
	]);

        $post->update([
    	    'title' => $request->input('title'),
    	    'content' => $request->input('content'),
    	    'published_at' => $request->input('published_at') ? $request->input('published_at') : $post->published_at,
	]);

	return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }


//    public function update(Request $request, Post $post)
//    {
//        $data = $request->validate([
//            'title' => 'required|string|max:255',
//            'content' => 'required|string',
//            'published_at' => 'nullable|date',
//        ]);
//        $post->update($data);
//        return redirect()->route('posts.index');
//    }

    public function destroy($id)
    {
	$post = Post::findOrFail($id);
	$post->delete();

	return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

        public function publish($id)
    {
        $post = Post::findOrFail($id);
        $post->update(['is_published' => true, 'published_at' => now()]);

        return redirect()->route('posts.index')->with('success', 'Post published successfully');
    }

    public function unpublish($id)
    {
        $post = Post::findOrFail($id);
        $post->update(['is_published' => false, 'published_at' => null]);

        return redirect()->route('posts.index')->with('success', 'Post unpublished successfully');
    }

}
