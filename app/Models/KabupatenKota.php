<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
    protected $fillable = [
        'nama',
    ];

    protected $table = 'kabupaten_kota';
}
