<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tutorial;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];
    //post
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }//

    public function tutorials()
    {
        return $this->belongsToMany(Tutorial::class, 'tutorial_tag');
    }
}
