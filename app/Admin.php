<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;

class Admin extends Authenticatable
{
    use Notifiable;


        protected $guard = 'admin';

        protected $fillable = [
            'name', 'email', 'password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
        public function sendPasswordResetNotification($token)
        {
        $this->notify(new ResetPasswordNotification($token));
        }
    }