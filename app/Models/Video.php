<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'tb_video';
    protected $primaryKey = 'idVideo';

    // Matikan timestamps karena tidak ada di skema
    public $timestamps = false;

    protected $fillable = [
        'judulVideo',
        'statusVideo',
        'urlYoutube'
    ];
}
