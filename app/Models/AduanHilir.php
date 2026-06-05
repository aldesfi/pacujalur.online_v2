<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AduanHilir extends Model
{
    protected $table = 'aduan_hilir';

    protected $fillable = [
        'nomor_hilir',
        'babak',
        'jalur_kiri_id',
        'jalur_kanan_id',
        'status',
        'pemenang',
    ];

    /**
     * Relasi ke Jalur yang berada di posisi KIRI
     */
    public function jalurKiri(): BelongsTo
    {
        return $this->belongsTo(Jalur::class, 'jalur_kiri_id');
    }

    /**
     * Relasi ke Jalur yang berada di posisi KANAN
     */
    public function jalurKanan(): BelongsTo
    {
        return $this->belongsTo(Jalur::class, 'jalur_kanan_id');
    }
}
