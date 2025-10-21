<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    protected $fillable = [
        'nama_kriteria',
        'simbol',
        'jenis_kriteria',
        'bobot',
        'keterangan',
    ];

    protected $casts = [
        'bobot' => 'decimal:4',
    ];

    public function penilaians(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }
}
