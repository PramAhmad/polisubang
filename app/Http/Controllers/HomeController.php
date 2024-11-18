<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Matakuliah;
use App\Models\Peminjaman;
use App\Models\Pengajuan;
use App\Models\Prasat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{ public function index()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        // Weekly statistics for both Peminjaman and Pengajuan
        $weeklyStats = Peminjaman::select(DB::raw('
            WEEK(created_at) as week,
            COUNT(*) as total_peminjaman,
            MIN(created_at) as week_start
        '))
        ->whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->groupBy('week')
        ->orderBy('week')
        ->get()
        ->map(function ($item) {
            $weekStart = Carbon::parse($item->week_start)->startOfWeek();
            $weekEnd = Carbon::parse($item->week_start)->endOfWeek();
            $item->week_label = $weekStart->format('M d') . ' - ' . $weekEnd->format('M d');
            return $item;
        });

        // Monthly statistics
        $monthlyStats = Peminjaman::select(DB::raw('
            MONTH(created_at) as month,
            COUNT(*) as total_peminjaman
        '))
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Get today's statistics
        $todayStats = [
            'peminjaman' => Peminjaman::whereDate('created_at', Carbon::today())->count(),
            'pengajuan' => Pengajuan::whereDate('created_at', Carbon::today())->count(),
            'prasat' => Prasat::whereDate('created_at', Carbon::today())->count()
        ];

        $statusCounts = [
            'peminjaman' => Peminjaman::select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status'),
            'pengajuan' => Pengajuan::select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status')
        ];

        $typeDistribution = [
            'peminjaman' => Peminjaman::select('type', DB::raw('count(*) as total'))
                ->groupBy('type')
                ->pluck('total', 'type'),
            'barang' => Barang::select('type', DB::raw('count(*) as total'))
                ->groupBy('type')
                ->pluck('total', 'type')
        ];

        $inventoryStats = [
            'total_items' => Barang::count(),
            'expired_soon' => Barang::whereDate('tanggal_expired', '<=', Carbon::now()->addDays(30))
                ->whereDate('tanggal_expired', '>', Carbon::now())
                ->count(),
            'expired' => Barang::whereDate('tanggal_expired', '<', Carbon::now())->count(),
            'low_stock' => Barang::where('jumlah', '<=', 5)->count(),
            'by_condition' => Barang::select('kondisi', DB::raw('count(*) as total'))
                ->groupBy('kondisi')
                ->pluck('total', 'kondisi')
        ];

        $latestPeminjaman = Peminjaman::with(['user', 'matakuliah'])
            ->latest()
            ->take(5)
            ->get();

        $latestPengajuan = Pengajuan::with(['user', 'matakuliah'])
            ->latest()
            ->take(5)
            ->get();

        $latestPrasat = Prasat::with(['pengajuan', 'peminjaman'])
            ->latest()
            ->take(5)
            ->get();

        $popularItems = Barang::select('nama_barang','jumlah', 'lokasi_barang', DB::raw('count(*) as usage_count'))
            ->groupBy('nama_barang', 'lokasi_barang','jumlah')
            ->orderByDesc('usage_count')
            ->take(5)
            ->get();

        $summary = [
            'total_peminjaman' => Peminjaman::count() ?? 0,
            'active_peminjaman' => Peminjaman::where('status', 'active')->count() ?? 0,
            'total_pengajuan' => Pengajuan::count(),
            'pending_pengajuan' => Pengajuan::where('status', 'pending')->count() ?? 0,
            'total_prasat' => Prasat::count(),
            'total_matakuliah' => Matakuliah::count(),
            'today_stats' => $todayStats,
            'inventory_stats' => $inventoryStats
        ];

        return view('home', compact(
            'weeklyStats',
            'monthlyStats',
            'summary',
            'statusCounts',
            'typeDistribution',
            'latestPeminjaman',
            'latestPengajuan',
            'latestPrasat',
            'popularItems',
            'currentYear',
            'currentMonth'
        ));
    }
    
}
