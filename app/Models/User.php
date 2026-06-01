<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use Notifiable, LogsActivity;

    protected $table = 'tb_users';

    protected $primaryKey = 'user_id';

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Admin');
    }
}
