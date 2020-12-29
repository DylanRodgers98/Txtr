<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $userIds = array($user->id, $user->following->pluck('id'));
        $posts = Post::whereIn('user_id', $userIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'userId' => 'required|integer',
            'parentPostId' => 'nullable|integer',
            'postBody' => 'required|string|max:140'
        ]);

        if ($request->hasFile('image') && !$request->file('image')->isValid()) {
            abort(500, 'An error occurred when uploading image.');
        }

        $post = Post::create([
            'user_id' => $validatedData['userId'],
            'parent_post_id' => $validatedData['parentPostId'] ?? null,
            'body' => $validatedData['postBody']
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('/public/img');
            $image = new Image(['url' => $imagePath]);
            $post->image()->save($image);
        }

        if ($request->has('parentPostId')) {
            return redirect()
                ->route('posts.show', ['post' => $validatedData['parentPostId']])
                ->with('message', 'Reply created!');
        }
        return redirect()
            ->route('home')
            ->with('message', 'Post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
            ->with('message', 'Post deleted.');
    }
}
