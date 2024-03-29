<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostDeletedByAdmin;
use App\Notifications\PostHasNewReply;
use App\Notifications\PostLiked;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->admin) {
            // if User is admin, index all Posts
            $posts = Post::orderBy('created_at', 'desc')
                ->orderBy('id', 'desc')
                ->simplePaginate(10);
        } else {
            // else index Posts only from followed Users
            $userIds = array_merge([$user->id], $user->following->pluck('id')->all());
            $posts = Post::whereIn('user_id', $userIds)
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc')
                ->simplePaginate(10);
        }

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
            $image = new Image(['url' => Storage::url($imagePath)]);
            $post->image()->save($image);
        }

        // if post is a reply, show reply
        if ($request->has('parentPostId')) {
            // send notification to User who posted parent post
            Post::findOrFail($validatedData['parentPostId'])
                ->user
                ->notify(new PostHasNewReply($post));

            return redirect()
                ->route('posts.show', ['post' => $post, '#post'])
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
        return view('posts.edit', ['post' => $post]);
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
        $validatedData = $request->validate([
            'postBody' => 'required|string|max:140'
        ]);

        if ($request->hasFile('image') && !$request->file('image')->isValid()) {
            abort(500, 'An error occurred when uploading image.');
        }

        $post->body = $validatedData['postBody'];

        if ($request->hasFile('image')) {
            // delete old image if there is one
            if ($post->image) {
                Storage::delete($post->image->url);
                $post->image()->delete();
            }

            // save new image
            $imagePath = $request->image->store('/public/img');
            $image = new Image(['url' => Storage::url($imagePath)]);
            $post->image()->save($image);
        }

        $post->save();

        return redirect()
            ->route('posts.show', ['post' => $post, '#post'])
            ->with('message', 'Post updated.');
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

        if (Auth::user()->admin && Auth::id() !== $post->user_id) {
            // if Post was deleted by an admin user, send notification to User who posted post
            $post->user->notify(new PostDeletedByAdmin());
        }

        return redirect()
            ->route('home')
            ->with('message', 'Post deleted.');
    }

    public function like(Post $post, User $user)
    {
        $post->likedBy()->attach($user->id);

        // send notification to User who posted post
        $post->user->notify(new PostLiked($post, $user));

        $numberOfLikes = $post->likedBy->count();
        return response()->json(['numberOfLikes' => $numberOfLikes]);
    }

    public function dislike(Post $post, User $user)
    {
        $post->likedBy()->detach($user->id);
        $numberOfLikes = $post->likedBy->count();
        return response()->json(['numberOfLikes' => $numberOfLikes]);
    }

    public function isLikedBy(Post $post, User $user)
    {
        $isLiked = in_array($user->id, $post->likedBy->pluck('id')->all());
        return response()->json(['isLiked' => $isLiked]);
    }
}
