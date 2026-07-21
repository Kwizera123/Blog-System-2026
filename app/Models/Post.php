<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\App;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'video_url',
        'status',
        'category_id',
        'user_id',
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    // End Method
    public function getEmbedVideoUrlAttribute()
{
    if (!$this->video_url) {
        return null;
    }

    $url = $this->video_url;

    if (str_contains($url, 'watch?v=')) {
        $url = str_replace('watch?v=', 'embed/', $url);
    }

    if (str_contains($url, 'youtu.be/')) {
        $url = str_replace('https://youtu.be/', 'https://www.youtube.com/embed/', $url);
    }

    return $url;
}



}
