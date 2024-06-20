<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Postingan extends Model
{
    use HasFactory;

    protected $table = 'post';
    protected $primaryKey = 'id';
    protected $fillable = ['foto', 'caption', 'user_id'];

    /**
     * Get the user that owns the post.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(like::class, 'post_id');
    }

    public function incrementLikesCount()
    {
        $this->increment('count_likes');
    }

    public function decrementLikesCount()
    {
        $this->decrement('count_likes');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, "post_id");
    }
}
