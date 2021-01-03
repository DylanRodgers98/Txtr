<?php

namespace App\Http\Controllers;

use App\Models\DisplayableNotification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Auth::user()->notifications()->simplePaginate(10);
        $displayableNotifications = [];

        foreach ($notifications as $notification) {
            $unread = $notification->unread();
            switch ($notification->type) {
                case "App\\Notifications\\NewFollower":
                    $follower = User::findOrFail($notification->data['follower_id']);
                    $followerProfile = $follower->profile;
                    $profileImageUrl = $followerProfile->profileImage->url ?? null;
                    $heading = $followerProfile->display_name . ' followed you';
                    $timestamp = $notification->created_at;
                    $notificationUrl = route('users.show', ['user' => $follower]);
                    $displayableNotifications[] = new DisplayableNotification(
                        $profileImageUrl, $heading, null, $timestamp, $notificationUrl, $unread);
                    break;
                case "App\\Notifications\\PostHasNewReply":
                    $reply = Post::findOrFail($notification->data['reply_id']);
                    $replyUserProfile = User::findOrFail($reply->user_id)->profile;
                    $profileImageUrl = $replyUserProfile->profileImage->url ?? null;
                    $heading = $replyUserProfile->display_name . ' replied to your post';
                    $subheading = $reply->body;
                    $timestamp = $notification->created_at;
                    $notificationUrl = route('posts.show', ['post' => $reply, '#post']);
                    $displayableNotifications[] = new DisplayableNotification(
                        $profileImageUrl, $heading, $subheading, $timestamp, $notificationUrl, $unread);
                    break;
                case "App\\Notifications\\PostLiked":
                    $replyUserProfile = User::findOrFail($notification->data['user_id'])->profile;
                    $profileImageUrl = $replyUserProfile->profileImage->url ?? null;
                    $heading = $replyUserProfile->display_name . ' liked your post';
                    $post = Post::findOrFail($notification->data['post_id']);
                    $subheading = $post->body;
                    $timestamp = $notification->created_at;
                    $notificationUrl = route('posts.show', ['post' => $post, '#post']);
                    $displayableNotifications[] = new DisplayableNotification(
                        $profileImageUrl, $heading, $subheading, $timestamp, $notificationUrl, $unread);
                    break;
            }
            $notification->markAsRead();
        }

        return view('notifications.index', [
            'notifications' => $displayableNotifications,
            'paginationLinks' => $notifications->links()
        ]);
    }
}
