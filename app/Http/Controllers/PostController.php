<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString();

        return view('blog', [
            'title' => "Blog",
            'posts' => $posts
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post', [
            'title' => $post['title'],
            'post' => $post
        ]);
    }
}
