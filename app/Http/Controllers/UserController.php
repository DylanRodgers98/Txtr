<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\NewFollower;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $posts = $user->posts()->simplePaginate(10);

        return view('users.show', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function indexFollowing(User $user)
    {
        return view('users.indexFollowing', ['user' => $user]);
    }

    public function indexFollowers(User $user)
    {
        return view('users.indexFollowers', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();

        if ($deleted && Auth::id() === $user->id) {
            Auth::logout();
        }

        if ($user->admin) {
            return redirect()
                ->route('users.index')
                ->with('message', 'User deleted.');
        }
        return redirect()->route('home');
    }

    public function isFollowing(User $user, User $userToQuery)
    {
        $isFollowing = in_array($user->id, $userToQuery->followers->pluck('id')->all());
        return response()->json(['isFollowing' => $isFollowing]);
    }

    public function follow(User $user, User $userToFollow)
    {
        $userToFollow->followers()->attach($user->id);
        $numberOfFollowers = $userToFollow->followers->count();

        // send notification to User being followed
        $userToFollow->notify(new NewFollower($user));

        return response()->json([
            'isFollowing' => true,
            'numberOfFollowers' => $numberOfFollowers
        ]);
    }

    public function unfollow(User $user, User $userToUnfollow)
    {
        $userToUnfollow->followers()->detach($user->id);
        $numberOfFollowers = $userToUnfollow->followers->count();

        return response()->json([
            'isFollowing' => false,
            'numberOfFollowers' => $numberOfFollowers
        ]);
    }
}
