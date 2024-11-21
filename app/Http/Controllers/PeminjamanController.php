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
    try {
        // Validate request first
        $validated = $request->validate([
            'nama_prasat' => 'required|array',
            'matakuliah_id' => 'required',
            'jadwal' => 'required',
            'npm' => 'required',
        ]);

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

        // Check if nama_prasat exists and is an array
        if ($request->has('nama_prasat') && is_array($request->nama_prasat)) {
            foreach ($request->nama_prasat as $prasatIndex => $namaPrasat) {
                $prasat = Prasat::create([
                    'peminjaman_id' => $peminjaman->id,
                    'nama_prasat' => $namaPrasat,
                    'type' => 'peminjaman',
                ]);

                // Check if barang_id and qty exist for this prasat
                if (isset($request->barang_id[$prasatIndex]) && 
                    isset($request->qty[$prasatIndex]) && 
                    is_array($request->barang_id[$prasatIndex]) && 
                    is_array($request->qty[$prasatIndex])) {
                    
                    foreach ($request->barang_id[$prasatIndex] as $barangIndex => $barangId) {
                        if (isset($request->qty[$prasatIndex][$barangIndex])) {
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
                    }
                }
            }
        }

        // Handle nama_prasat_lain
        if ($request->has('nama_prasat_lain') && is_array($request->nama_prasat_lain)) {
            foreach ($request->nama_prasat_lain as $key => $value) {
                if (!empty($value)) {
                    $prasat = Prasat::create([
                        'peminjaman_id' => $peminjaman->id,
                        'nama_prasat' => $value,
                        'type' => 'peminjaman',
                    ]);

                    $gambarName = null;
                    
                    // Check if gambar exists and is valid
                    if (isset($request->gambar[$key]) && 
                        is_array($request->gambar[$key]) && 
                        isset($request->gambar[$key][0]) && 
                        $request->gambar[$key][0] instanceof \Illuminate\Http\UploadedFile) {
                        
                        $gambar = $request->gambar[$key][0];
                        $gambarName = time() . '_' . $gambar->getClientOriginalName();
                        $gambar->move(public_path('upload/gambar'), $gambarName);
                    }

                    // Check if all required arrays and indices exist
                    $namaBarang = isset($request->nama_barang_lain[$key][0]) ? $request->nama_barang_lain[$key][0] : null;
                    $jumlah = isset($request->jumlah_lain[$key][0]) ? $request->jumlah_lain[$key][0] : 0;
                    $estimasiHarga = isset($request->estimasi_harga[$key][0]) ? $request->estimasi_harga[$key][0] : 0;

                    PeminjamanBarangLainya::create([
                        'prasat_id' => $prasat->id,
                        'nama_barang' => $namaBarang,
                        'jumlah' => $jumlah,
                        'estimasi_harga' => $estimasiHarga,
                        'gambar' => $gambarName,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true, 
            'message' => 'Peminjaman created successfully', 
            '_token' => csrf_token()
        ]);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}
    public function show($id)
    {
     
        $peminjaman = Peminjaman::with('prasat','prasat.barangByPrasat','prasat.peminjaman_barang_lainya')->findOrFail($id);
        if (!$peminjaman) {
            return response()->json(['success' => false, 'message' => 'Peminjaman not found'], 404);
        }
        // return $peminjaman;  
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit($id)
    {
        // dd("ppp");
        $peminjaman = Peminjaman::findOrFail($id);
        $barangs = Barang::all();
        $matakuliahs = Matakuliah::all();
        return view('peminjaman.edit', compact('peminjaman','barangs','matakuliahs'));

     }

     public function update(Request $request, $id)
     {
         $peminjaman = Peminjaman::find($id);
         if (!$peminjaman) {
             return response()->json(['success' => false, 'message' => 'peminjaman not found'], 404);
         }
     
         try {
             $peminjaman->update([
                 'user_id' => auth()->user()->id,
                 'name' => auth()->user()->name,
                 'matakuliah_id' => $request->matakuliah_id,
                 'status' => 'pending',
             ]);
     
             $existingPrasatIds = [];
     
             foreach ($request->nama_prasat as $prasatIndex => $namaPrasat) {
                 $prasat = Prasat::where('peminjaman_id', $peminjaman->id)
                     ->where('nama_prasat', $namaPrasat)
                     ->first();
     
                 if (!$prasat) {
                     $prasat = Prasat::create([
                         'peminjaman_id' => $peminjaman->id,
                         'nama_prasat' => $namaPrasat,
                         'type' => 'peminjaman'
                     ]);
                 }
     
                 $existingPrasatIds[] = $prasat->id;
     
                 if (isset($request->barang_id[$prasatIndex]) && isset($request->qty[$prasatIndex])) {
                     BarangByPrasat::where('prasat_id', $prasat->id)->delete();
     
                     foreach ($request->barang_id[$prasatIndex] as $barangIndex => $barangId) {
                         $qty = $request->qty[$prasatIndex][$barangIndex];
                         $barang = Barang::find($barangId);
                         
                         if ($barang) {
                             BarangByPrasat::create([
                                 'prasat_id' => $prasat->id,
                                 'barang_id' => $barang->id,
                                 'qty' => is_numeric($qty) ? (int)$qty : 0
                             ]);
                         } else {
                             throw new \Exception("Barang dengan ID: $barangId tidak ditemukan untuk prasat index: $prasatIndex");
                         }
                     }
                 }
             }
     
             if ($request->has('nama_prasat_lain') && !empty($request->nama_prasat_lain)) {
                 foreach ($request->nama_prasat_lain as $key => $value) {
                     if (!empty($value)) {
                         $prasat = Prasat::create([
                             'peminjaman_id' => $peminjaman->id,
                             'nama_prasat' => $value,
                             'type' => 'peminjaman'
                         ]);
     
                         $existingPrasatIds[] = $prasat->id;
     
                         $gambarName = null;
                         if (isset($request->gambar[$key]) && $request->gambar[$key]) {
                             $gambar = $request->file('gambar')[$key];
                             $gambarName = time() . '_' . $gambar->getClientOriginalName();
                             $gambar->storeAs('upload/gambar', $gambarName);
                         }
     
                         peminjamanBarangLainya::create([
                             'prasat_id' => $prasat->id,
                             'nama_barang' => $request->nama_barang_lain[$key],
                             'jumlah' => $request->jumlah_barang_lain[$key],
                             'estimasi_harga' => $request->estimasi_harga_barang_lain[$key],
                             'gambar' => $gambarName
                         ]);
                     }
                 }
             }
     
             Prasat::where('peminjaman_id', $peminjaman->id)
                 ->whereNotIn('id', $existingPrasatIds)
                 ->delete();
     
         } catch (\Exception $e) {
             return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
         }
     
         return redirect()->route('peminjaman.index')->with('success', 'peminjaman updated successfully');
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
