<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'title',
        'introduction',
        'mission_title',
        'mission_content',
        'teaching_title',
        'teaching_content',
        'audience_title',
        'audience_content',
        'why_learn_title',
        'why_learn_content',
        'cta_title',
        'cta_content',
    ];
    //
}
