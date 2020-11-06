<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Post', 'parent_post_id');
    }

    /**
     * A Post may be a 'comment', which has the same properties as a Post but
     * is a reply to another Post or comment, and so has a reference to a 
     * 'parent' Post. A Post with no parent Post is therefore not a comment. 
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo the BelongsTo
     * part of a one-to-many relationship between a Post and its comments, who
     * themselves are also Posts.
     */
    public function parentPost()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
