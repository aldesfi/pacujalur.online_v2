<?php

namespace App\Http\Controllers;

use App\Models\AduanHilir;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    /**
     * Display the results input page
     */
    public function index()
    {
        return view('input-results');
    }

    /**
     * Get all aduan with relationships
     */
    public function getList()
    {
        $aduan = AduanHilir::with(['jalurKiri.asal', 'jalurKanan.asal'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($aduan);
    }

    /**
     * Update aduan result
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:0,1,2',
            'pemenang' => 'nullable|in:kiri,kanan'
        ]);

        $aduan = AduanHilir::findOrFail($id);
        $aduan->update($validated);

        return response()->json(['message' => 'Hasil berhasil diupdate'], 200);
    }
}
