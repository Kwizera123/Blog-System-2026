<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
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
        $url = str_replace('https://youtu.be/',
         'https://www.youtube.com/embed/',
          $url
          );
    }

    return $url;
}
        /**
     * Use slug instead of ID in URLs
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

        /**
     * Generate unique slug
     */


    public static function generateSlug($title)
    {
        $slug = Str::slug($title);

        $count = 1;

       while (self::where('slug', $slug)->exists()) {

            $slug = Str::slug($title) . '-' . $count;

            $count++;

        }
         
        return $slug;
    } 
     

}
