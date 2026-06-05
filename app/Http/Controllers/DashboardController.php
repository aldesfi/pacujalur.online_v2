<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jalur;
use App\Models\Asal;
use App\Models\AduanHilir;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalUser = User::count();
        $totalJalur = Jalur::count();
        $totalAsal = Asal::count();
        $totalAduan = AduanHilir::count();

        $asalList = Asal::all();
        $jalurList = Jalur::with('asal')->get();

        return view('dashboard', compact(
            'totalUser',
            'totalJalur',
            'totalAsal',
            'totalAduan',
            'asalList',
            'jalurList'
        ));
    }
}
