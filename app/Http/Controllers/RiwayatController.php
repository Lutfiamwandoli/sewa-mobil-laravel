<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPemesanan;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ambil user login

        $riwayat = DataPemesanan::with(['mobil', 'paket'])
            ->where('id_user', $user->id_user)
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        return view('user.riwayat.index', compact('riwayat', 'user'));
    }
}
