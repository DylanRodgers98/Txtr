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

        $isBannerImageValid = true;
        if ($request->hasFile('bannerImage')) {
            $isBannerImageValid = $request->file('bannerImage')->isValid();
        }

        $isProfileImageValid = true;
        if ($request->hasFile('profileImage')) {
            $isProfileImageValid = $request->file('profileImage')->isValid();
        }

        if (!$isBannerImageValid || !$isProfileImageValid) {
            $failureMsg = 'An error occurred when uploading ';

            if (!$isBannerImageValid && !$isProfileImageValid) {
                $failureMsg = $failureMsg . 'banner image and profile image';
            } else if (!$isBannerImageValid && $isProfileImageValid) {
                $failureMsg = $failureMsg . 'banner image';
            } else if ($isBannerImageValid && !$isProfileImageValid) {
                $failureMsg = $failureMsg . 'profile image';
            }

            abort(500, $failureMsg);
        }

        $user->profile->display_name = $validatedData['displayName'];
        $user->profile->bio = $validatedData['bio'];
        $user->profile->location = $validatedData['location'];
        $user->profile->website_url = $validatedData['websiteUrl'];

        if ($request->hasFile('bannerImage')) {
            // delete old banner image if there is one
            if ($user->profile->bannerImage) {
                Storage::delete($user->profile->bannerImage->url);
                $user->profile->bannerImage()->delete();
            }

            // save new banner image
            $bannerImagePath = $request->image->store('/public/img');
            $bannerImage = new Image(['url' => Storage::url($bannerImagePath)]);
            $user->profile->bannerImage()->save($bannerImage);
        }

        if ($request->hasFile('profileImage')) {
            // delete old profile image if there is one
            if ($user->profile->profileImage) {
                Storage::delete($user->profile->profileImage->url);
                $user->profile->profileImage()->delete();
            }

            // save new profile image
            $profileImagePath = $request->image->store('/public/img');
            $profileImage = new Image(['url' => Storage::url($profileImagePath)]);
            $user->profile->profileImage()->save($profileImage);
        }

        $user->profile->save();

        return redirect()
            ->route('users.show', ['user' => $user])
            ->with('message', 'Profile updated.');
    }
}
