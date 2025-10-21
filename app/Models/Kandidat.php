<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kandidat extends Model
{
    protected $fillable = [
        'nama_kandidat',
        'asal_daerah',
        'foto',
        'info_lain',
    ];

    public function penilaians(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }

    public function hasils(): HasMany
    {
        return $this->hasMany(Hasil::class);
    }
}
