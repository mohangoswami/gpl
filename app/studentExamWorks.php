<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class studentExamWorks extends Model
{
    protected $fillable = [
        'titleId','class', 'name', 'email', 'subject', 'title', 'fileSize', 'fileUrl','submittedDone',
    ];

}
