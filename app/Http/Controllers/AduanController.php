<?php

namespace App\Http\Controllers;

use App\Models\AduanHilir;

class AduanController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar aduan
     */
    public function index()
    {
        // Tarik data aduan beserta relasi jalur dan asalnya sekaligus
        $daftarAduan = AduanHilir::with([
            'jalurKiri.asal',
            'jalurKanan.asal',
        ])
            ->orderBy('id', 'asc') // Urutkan berdasarkan hilir terkecil
            ->get();

        // Contoh kalau mau filter yang statusnya 'Sedang Bersiap' (1) dan 'Selesai' (2) saja
        // $daftarAduan = AduanHilir::with(['jalurKiri.asal', 'jalurKanan.asal'])
        //         ->whereIn('status', [1, 2])
        //         ->orderBy('nomor_hilir', 'asc')
        //         ->get();

        // Kirim variabel $daftarAduan ke file view resources/views/index.blade.php
        return view('index', compact('daftarAduan'));
    }
}
