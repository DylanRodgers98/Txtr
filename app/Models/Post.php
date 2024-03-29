<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_post_id',
        'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Post::class, 'parent_post_id');
    }

    /**
     * A Post may be a 'reply', which has the same properties as a Post but is
     * a reply to another Post or reply, and so has a reference to a 'parent'
     * Post. A Post with no parent Post is therefore not a reply.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo the BelongsTo
     * part of a one-to-many relationship between a Post and its replies, who
     * themselves are also Posts.
     */
    public function parentPost()
    {
        return $this->belongsTo(Post::class);
    }

    public function parentPosts()
    {
        $posts = array();
        $currentPost = $this;
        while ($currentPost->parentPost) {
            $currentPost = $currentPost->parentPost;
            $posts[] = $currentPost;
        }
        return array_reverse($posts);
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'user_liked_post');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
