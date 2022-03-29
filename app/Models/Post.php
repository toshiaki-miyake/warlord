<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Post -> posts
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'deadline',
    ];

    // $post->comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
