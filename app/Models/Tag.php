<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //post
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
