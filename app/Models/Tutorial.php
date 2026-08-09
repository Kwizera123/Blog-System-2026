<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class Tutorial extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'image',
        'video_url',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //
}
