<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aduan_hilir', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_hilir'); // Contoh: HILIR 01, HILIR 02
            $table->string('babak');        // Contoh: Putaran I, Putaran II, Semi Final

            // Relasi ke jalur posisi KIRI
            $table->foreignId('jalur_kiri_id')->constrained('jalur')->onDelete('cascade');

            // Relasi ke jalur posisi KANAN
            $table->foreignId('jalur_kanan_id')->constrained('jalur')->onDelete('cascade');

            // Status pertandingan: 0 = Belum, 1 = Bersiap, 2 = Selesai
            $table->tinyInteger('status')->default(0);

            // Menentukan pemenang: 'kiri', 'kanan', atau NULL jika belum selesai bertanding
            $table->enum('pemenang', ['kiri', 'kanan'])->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aduan_hilir');
    }
};
