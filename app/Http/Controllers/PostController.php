<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggested_users = auth()->user()->suggested_users();
        $posts = Post::all();
        return view('posts.index', compact('posts', 'suggested_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
            'image' => ['required', 'mimes:jpeg,jpg,png,gif']
        ]);

        $image = $request['image']->store('posts', 'public');

        $data['image'] = $image;
        $data['slug'] = Str::random(10);

        auth()->user()->posts()->create($data);

        // $data['user_id'] = auth()->id();
        // Post::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("posts.show", compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("posts.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'description' => 'required',
            'image' => ['nullable', 'mimes:jpeg,jpg,png,gif']
        ]);

        if ($request->has('image')) {
            $image = $request['image']->store('posts', 'public');
            $data['image'] = $image;
        }

        $post->update(($data));

        return redirect('/p/' . $post->slug . '/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete('public/' . $post->image);

        $post->delete();

        return redirect(url('home'));
    }
}
