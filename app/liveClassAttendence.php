<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class liveClassAttendence extends Model
{
    use HasFactory;
    protected $fillable = [
        'type','name',  'email', 'class', 'subject',
    ];

}
