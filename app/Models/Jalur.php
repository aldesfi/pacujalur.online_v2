<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jalur extends Model
{
    protected $table = 'jalur';

    protected $fillable = ['nama_jalur', 'desa', 'asal_id'];

    /**
     * Relasi ke data Asal (Jalur ini berasal dari asal mana)
     */
    public function asal(): BelongsTo
    {
        return $this->belongsTo(Asal::class, 'asal_id');
    }
}
