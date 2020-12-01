<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $guard = 'teacher';

    protected $fillable = [
        'class', 'name', 'email', 'subject', 'title', 'discription', 'fileSize', 'fileUrl', 'examUrl', 'maxMarks', 'startExam', 'endExam', 'studentReturn', 'topperShown', 'type',
    ];
}
