<?php

use App\Models\AduanHilir;
use App\Models\Jalur;
use App\Models\Asal;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Insert Asal Dummy
        $kecA = Asal::create(['nama_asal' => 'Asal A']);
        $kecB = Asal::create(['nama_asal' => 'Asal B']);
        $kecC = Asal::create(['nama_asal' => 'Asal C']);

        // 2. Insert Jalur Dummy
        $jalur1 = Jalur::create(['nama_jalur' => 'Jalur 1', 'desa' => 'Desa X', 'asal_id' => $kecA->id]);
        $jalur2 = Jalur::create(['nama_jalur' => 'Jalur 2', 'desa' => 'Desa Y', 'asal_id' => $kecB->id]);
        $jalur3 = Jalur::create(['nama_jalur' => 'Jalur 3', 'desa' => 'Desa Z', 'asal_id' => $kecC->id]);
        $jalur4 = Jalur::create(['nama_jalur' => 'Jalur 4', 'desa' => 'Desa W', 'asal_id' => $kecA->id]);

        // 3. Insert Jadwal Aduan Dummy
        // Hilir 1: Jalur 1 (Kiri) vs Jalur 2 (Kanan), Status Selesai, Pemenang Kiri
        AduanHilir::create([
            'nomor_hilir' => 'HILIR 01',
            'babak' => 'Putaran I',
            'jalur_kiri_id' => $jalur1->id,
            'jalur_kanan_id' => $jalur2->id,
            'status' => 2, // Selesai
            'pemenang' => 'kiri',
        ]);

        // Hilir 2: Jalur 3 (Kiri) vs Jalur 4 (Kanan), Status Sedang Bersiap, Belum ada pemenang
        AduanHilir::create([
            'nomor_hilir' => 'HILIR 02',
            'babak' => 'Putaran I',
            'jalur_kiri_id' => $jalur3->id,
            'jalur_kanan_id' => $jalur4->id,
            'status' => 1, // Sedang Bersiap
            'pemenang' => null,
        ]);
    }
}
