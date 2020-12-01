<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stuHomeworkUpload extends Model
{
    protected $fillable = [
        'titleId','class', 'name', 'email', 'subject', 'title', 'fileSize', 'fileUrl',
    ];
}
