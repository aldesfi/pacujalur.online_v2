<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Jalur;
use App\Models\Asal;
use App\Models\AduanHilir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataMasterController extends Controller
{
    /**
     * Store Asal
     */
    public function storeAsal(Request $request)
    {
        $validated = $request->validate([
            'nama_asal' => 'required|string|unique:asal'
        ]);

        Asal::create($validated);

        return response()->json(['message' => 'Asal berhasil ditambahkan'], 201);
    }

    /**
     * Store Jalur
     */
    public function storeJalur(Request $request)
    {
        $validated = $request->validate([
            'nama_jalur' => 'required|string',
            'desa' => 'required|string',
            'asal_id' => 'required|exists:asal,id'
        ]);

        Jalur::create($validated);

        return response()->json(['message' => 'Jalur berhasil ditambahkan'], 201);
    }

    /**
     * Store Aduan Hilir
     */
    public function storeAduan(Request $request)
    {
        $validated = $request->validate([
            'nomor_hilir' => 'required|string|unique:aduan_hilir',
            'babak' => 'required|string',
            'jalur_kiri_id' => 'required|exists:jalur,id',
            'jalur_kanan_id' => 'required|exists:jalur,id',
            'status' => 'required|in:0,1,2'
        ]);

        AduanHilir::create($validated);

        return response()->json(['message' => 'Aduan berhasil ditambahkan'], 201);
    }

    /**
     * Store User
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified_at'] = now();

        User::create($validated);

        return response()->json(['message' => 'User berhasil ditambahkan'], 201);
    }
}
