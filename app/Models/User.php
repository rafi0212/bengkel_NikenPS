<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'email'; // Primary key menggunakan email
    public $incrementing = false;   // Non-auto increment
    protected $keyType = 'string'; // Tipe data primary key adalah string

    protected $fillable = [
        'email',
        'username',
        'password',
        'status_pekerjaan',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
