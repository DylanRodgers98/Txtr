<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::id() != $user->id) {
            return abort(403, "You are not authorized to edit another user's profile");
        }
        return view('profile.edit', ['user' => $user]);
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
        $validatedData = $request->validate([
            'displayName' => 'required|string|max:50',
            'bio' => 'nullable|string|max:140',
            'location' => 'nullable|string|max:30',
            'websiteUrl' => 'nullable|url|max:100'
        ]);

        if ($request->hasFile('profileImage') && !$request->file('profileImage')->isValid()) {
            abort(500, 'An error occurred when uploading profile image');
        }

        $user->profile->display_name = $validatedData['displayName'];
        $user->profile->bio = $validatedData['bio'];
        $user->profile->location = $validatedData['location'];
        $user->profile->website_url = $validatedData['websiteUrl'];

        if ($request->hasFile('profileImage')) {
            // delete old profile image if there is one
            if ($user->profile->profileImage) {
                Storage::delete($user->profile->profileImage->url);
                $user->profile->profileImage()->delete();
            }

            // save new profile image
            $profileImagePath = $request->profileImage->store('/public/img');
            $profileImage = new Image(['url' => Storage::url($profileImagePath)]);
            $user->profile->profileImage()->save($profileImage);
        }

        $user->profile->save();

        return redirect()
            ->route('users.show', ['user' => $user])
            ->with('message', 'Profile updated.');
    }
}
