<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Matakuliah;
use App\Models\Peminjaman;
use App\Models\Pengajuan;
use App\Models\Prasat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::all();
        $pengajuan = Pengajuan::all();
        $jumlahMatkul = Matakuliah::count();
        $barang = Barang::count();
        $prasat = Prasat::count();
        return view('home');
    }
}
