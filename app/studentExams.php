<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class studentExams extends Model
{
    protected $fillable = [
    'titleId', 'class', 'name', 'email', 'subject', 'title','submittedDone','marksObtain','maxMarks',
    ];
}
