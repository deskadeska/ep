<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_users';

    // Sesuaikan Primary Key dengan skema baru
    protected $primaryKey = 'user_id';

    // public $timestamps = false; // BARI INI DIHAPUS, biarkan Laravel menangani timestamps otomatis

    protected $fillable = [
        'namaLengkapUser',
        'tipeUser',
        'jkUser',
        'noTelpUser',
        'email',
        'password',
        'fotoUser'
    ];

    protected $hidden = [
        'password',
    ];
}
