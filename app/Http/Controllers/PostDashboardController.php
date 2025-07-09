<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PostDashboardController extends Controller
{
    protected $type;
    protected $message;

    protected function toast(string $route, string $type, string $message) : RedirectResponse {
        return redirect($route)->with($type, $message);
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $posts = Post::latest()->where('author_id', Auth::user()->id);

        if (request('search')) {
            $posts->where('title', 'like', '%'. request('search') .'%');
        }

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'posts' => $posts->paginate(5)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('dashboard.create', [
            'title' => "Add New Post",
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request) : RedirectResponse
    {
        $validatedData = $request->validated();

        Post::create($validatedData);

        return $this->toast(route('dashboard.index'), 'success', 'Successfully Add a New Post');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) : View
    {
        return view('dashboard.show', [
            'title' => $post->title,
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post) : View
    {
        return view('dashboard.edit', [
            'title' => $post->title,
            'categories' => Category::all(),
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post) : RedirectResponse
    {
        $validatedData = $request->validated();

        Post::where('slug', $post->slug)->update($validatedData);

        return $this->toast(route('dashboard.index'), 'success', 'Successfully Updated a Post');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $this->toast(route('dashboard.index'), 'delete', 'Successfully Removed a Post');
    }
}
