<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutItem extends Model
{
    protected $fillable = [
        'about_page_id',
        'section',
        'content',
        'sort_order',
    ];

    public function aboutPage()
    {
        return $this->belongsTo(AboutPage::class);
    }
    //

}
