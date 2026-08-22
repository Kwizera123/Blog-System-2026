<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    protected $fillable = [
        'title',
        'introduction',
        'email',
        'phone',
        'address',
    ];
    //
}
