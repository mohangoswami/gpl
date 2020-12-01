<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class flashNews extends Model
{
    protected $guard = 'admin';

    protected $fillable = [
        'news', 
    ];
}
