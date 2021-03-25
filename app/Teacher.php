<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use Notifiable;


        protected $guard = 'teacher';

        protected $fillable = [
            'name', 'email', 'password', 'class_code0', 'class_code1', 'class_code2', 'class_code3', 'class_code4', 'class_code5', 'class_code6', 'class_code7', 'class_code8', 'class_code9', 'class_code10', 'class_code11', 'teacherImg', 
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
    }