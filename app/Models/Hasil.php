<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hasil extends Model
{
    protected $fillable = [
        'kandidat_id',
        'nilai_total_saw',
        'ranking',
        'detail_perhitungan',
    ];

    protected $casts = [
        'nilai_total_saw' => 'decimal:6',
        'detail_perhitungan' => 'array',
    ];

    public function kandidat(): BelongsTo
    {
        return $this->belongsTo(Kandidat::class);
    }
}
