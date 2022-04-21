<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword ;

class tamu extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory;
    use Notifiable;

    protected $table = 'tamu';
    protected $primary_key = 'id';
    protected $fillable = ['nama_tamu','username','email','password','no_hp','remember_token', 'email_veified_at'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
