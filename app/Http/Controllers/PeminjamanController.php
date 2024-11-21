<?php

namespace App\Http\Controllers;

use App\DataTables\PeminjamanDataTable;
use App\Models\Barang;
use App\Models\BarangByPrasat;
use App\Models\Matakuliah;
use App\Models\Peminjaman;
use App\Models\PeminjamanBarangLainya;
use App\Models\Prasat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Spatie\LaravelPdf\Support\pdf;

class PeminjamanController extends Controller
{
    public function index(PeminjamanDataTable $datatable)
    {
        return $datatable->render('peminjaman.index');
    }

    public function create(Request $request)
    {
        // get auth role name 
     
        try {
            $peminjaman = Peminjaman::create([
                'user_id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'matakuliah_id' => $request->matakuliah_id,
                'status' => 'pending',
                'jadwal' => $request->jadwal ?? now(),
                'npm' => $request->npm ?? "tidak ada npm",
                'type' => auth()->user()->getRoleNames()->first(),
                'code' => 'P' . time(),
                
            ]);
    
            foreach ($request->nama_prasat as $prasatIndex => $namaPrasat) {
                $prasat = Prasat::create([
                    'peminjaman_id' => $peminjaman->id,
                    'nama_prasat' => $namaPrasat,
                    'type' => 'peminjaman',
                ]);
    
                if (isset($request->barang_id[$prasatIndex]) && isset($request->qty[$prasatIndex])) {
                    foreach ($request->barang_id[$prasatIndex] as $barangIndex => $barangId) {
                        $qty = $request->qty[$prasatIndex][$barangIndex];
    
                        $barang = Barang::find($barangId);
                        if ($barang) {
                            BarangByPrasat::create([
                                'prasat_id' => $prasat->id,
                                'barang_id' => $barang->id,
                                'qty' => is_numeric($qty) ? (int)$qty : 0, 
                            ]);
                        } else {
                            throw new \Exception("Barang dengan ID: $barangId tidak ditemukan untuk prasat index: $prasatIndex");
                        }
                    }
                } else {
                    throw new \Exception("ID Barang atau Qty tidak valid untuk prasat index: $prasatIndex");
                }
            }
    
            if ($request->has('nama_prasat_lain') && !empty($request->nama_prasat_lain)) {
                foreach ($request->nama_prasat_lain as $key => $value) {
                    if (!empty($value)) {
                        $prasat = Prasat::create([
                            'peminjaman_id' => $peminjaman->id,
                            'nama_prasat' => $value,
                            'type' => 'peminjaman',
                        ]);
            
                        $gambarName = null;
                        if (isset($request->gambar[$key]) && $request->gambar[$key]) {
                            $gambar = $request->file('gambar')[$key];
                            $gambarName = time() . '_' . $request->nama_prasat_lain[$key] . '.' . $gambar->getClientOriginalExtension();
                            $gambar->storeAs('upload/gambar', $gambarName);
                        }
            
                        PeminjamanBarangLainya::create([
                            'prasat_id' => $prasat->id,
                            'nama_barang' => $request->nama_barang_lain[$key],
                            'jumlah' => $request->jumlah_barang_lain[$key],
                            'estimasi_harga' => $request->estimasi_harga_barang_lain[$key],
                            'gambar' => $gambarName,
                        ]);
                    }
                }
            } else {
                throw new \Exception('Field nama_prasat_lain tidak boleh kosong.');
            }
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    
        return response()->json(['success' => true, 'message' => 'Peminjaman created successfully', '_token' => csrf_token()]);
  
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::find($id);
        if (!$peminjaman) {
            return response()->json(['success' => false, 'message' => 'Peminjaman not found'], 404);
        }
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json(['success' => false, 'message' => 'Peminjaman not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $peminjaman, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required|min:3|max:100'
        ]);

        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json(['success' => false, 'message' => 'Peminjaman not found'], 404);
        }

        $update = $request->all();

        $peminjaman->update($update);

        return response()->json(['success' => true, 'message' => 'Peminjaman update successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json(['success' => true, 'message' => 'Peminjaman not found'], 404);
        }

        $peminjaman->delete();
        return redirect()->back()->with('success','Peminjaman berhasil dihapus');
        
        }

    public function form(){
        $barangs = Barang::all();
        $matakuliahs = Matakuliah::all();
        return view('peminjaman.form', compact('barangs','matakuliahs'));
    }

    public function download($id)
    {
        $peminjaman = Peminjaman::find($id);
        return pdf()->view('peminjaman.download', compact('peminjaman'))->name(now()->format('Y-m-d') . '-peminjaman-' . $peminjaman->code . '.pdf')->download();
    }
}
