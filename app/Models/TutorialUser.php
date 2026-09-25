<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TutorialUser extends Pivot
{
    protected $casts = [
        'completed_at' => 'datetime',
    ];
    //
}
