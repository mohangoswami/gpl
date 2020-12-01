<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class classwork extends Model
{
    protected $guard = 'teacher';

    protected $fillable = [
        'class', 'name', 'email', 'subject', 'title', 'discription', 'fileSize', 'fileUrl', 'studentReturn', 'youtubeLink','type',
    ];

}
