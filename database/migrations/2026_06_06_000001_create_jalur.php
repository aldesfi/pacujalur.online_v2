<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jalur', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jalur');
            $table->string('desa')->nullable();
            // Relasi ke tabel asal
            $table->foreignId('asal_id')->constrained('asal')->onDelete('cascade');
            // $table->foreignId('asal_id')->constrained('asal')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jalur');
    }
};
