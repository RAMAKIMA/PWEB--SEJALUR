<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use Notifiable;
    protected $table = 'accounts';

    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'no_telepon',
        'role',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
