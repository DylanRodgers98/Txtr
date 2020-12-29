<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'display_name',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function profileImage()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function bannerImage()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
