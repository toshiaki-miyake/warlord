<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
        // $posts = Post::latest()->get();
        $posts = Post::all()->sortBy('priority');

        return view('index')
            ->with(['posts' => $posts]);
    }
    public function show(Post $post)
    {
        return view('posts.show')
            ->with(['post' => $post]);
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->priority = $request->priority;
        $post->deadline = $request->deadline;
        $post->save();

        return redirect()
            ->route('posts.index');
    }
    public function edit(Post $post)
    {
        return view('posts.edit')
            ->with(['post' => $post]);
    }

    public function update(PostRequest $request, Post $post) {
        $post->title = $request->title;
        $post->body = $request->body;
        $post->priority = $request->priority;
        $post->deadline = $request->deadline;
        $post->save();

        return redirect()
            ->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()
            ->route('posts.index');
    }
}
