<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asal extends Model
{
    // Menentukan nama tabel secara eksplisit (opsional jika nama jamak/tunggal sesuai standar)
    protected $table = 'asal';

    protected $fillable = ['nama_asal'];

    /**
     * Relasi ke data Jalur (Satu asal punya banyak jalur)
     */
    public function jalur(): HasMany
    {
        return $this->hasMany(Jalur::class, 'asal_id');
    }
}
