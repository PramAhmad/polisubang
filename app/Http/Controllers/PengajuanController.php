<?php

namespace App\Http\Controllers;

use App\DataTables\PengajuanDataTable;
use App\Models\Barang;
use App\Models\BarangByPrasat;
use App\Models\Matakuliah;
use App\Models\Pengajuan;
use App\Models\PengajuanBarangLainya;
use App\Models\Prasat;
use Illuminate\Http\Request;

use function Spatie\LaravelPdf\Support\pdf;

class PengajuanController extends Controller
{
    public function index(PengajuanDataTable $datatable)
    {
        return $datatable->render('pengajuan.index');
    }

    public function create(Request $request)
    {
       
        try {
            $pengajuan = Pengajuan::create([
                'user_id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'matakuliah_id' => $request->matakuliah_id,
                'status' => 'pending',
            ]);
    
            foreach ($request->nama_prasat as $prasatIndex => $namaPrasat) {
                $prasat = Prasat::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama_prasat' => $namaPrasat,
                    'type' => 'pengajuan',
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
    
            if ($request->has('nama_prasat_lain') && is_array($request->nama_prasat_lain)) {
                foreach ($request->nama_prasat_lain as $key => $value) {
                    if (!empty($value)) {
                        $prasat = Prasat::create([
                            'pengajuan_id' => $pengajuan->id,
                            'nama_prasat' => $value,
                            'type' => 'pengajuan',
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
    
                        PengajuanBarangLainya::create([
                            'prasat_id' => $prasat->id,
                            'nama_barang' => $namaBarang,
                            'jumlah' => $jumlah,
                            'estimasi_harga' => $estimasiHarga,
                            'gambar' => $gambarName,
                        ]);
                    }
                }
            }
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    
        return response()->json(['success' => true, 'message' => 'Pengajuan created successfully', '_token' => csrf_token()]);
    }
    
    public function show($id)
    {
    $pengajuan = Pengajuan::with('prasat.barangByPrasat')->find($id);
    
        if (!$pengajuan) {
            return response()->json(['success' => false, 'message' => 'pengajuan not found'], 404);
        }
    
        return view('pengajuan.show', compact('pengajuan'));
    }
    

    public function edit($id)
    {
        $pengajuan = pengajuan::find($id);
        $barangs = Barang::all();
        $matakuliahs = Matakuliah::all();
        return view('pengajuan.edit', compact('pengajuan','barangs','matakuliahs'));
    }

    
    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::find($id);
    
        if (!$pengajuan) {
            return response()->json(['success' => false, 'message' => 'Pengajuan not found'], 404);
        }
    
        try {
            $pengajuan->update([
                'user_id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'matakuliah_id' => $request->matakuliah_id,
                'status' => 'pending',
            ]);
    
            foreach ($request->nama_prasat as $prasatIndex => $namaPrasat) {
                $prasat = Prasat::updateOrCreate(
                    [
                        'pengajuan_id' => $pengajuan->id,
                        'nama_prasat' => $namaPrasat,
                        'type' => 'pengajuan'
                    ]
                );
    
                if (isset($request->barang_id[$prasatIndex]) && isset($request->qty[$prasatIndex])) {
                    foreach ($request->barang_id[$prasatIndex] as $barangIndex => $barangId) {
                        $qty = $request->qty[$prasatIndex][$barangIndex];
    
                        $barang = Barang::find($barangId);
                        if ($barang) {
                            BarangByPrasat::updateOrCreate(
                                [
                                    'prasat_id' => $prasat->id,
                                    'barang_id' => $barang->id,
                                ],
                                [
                                    'qty' => is_numeric($qty) ? (int)$qty : 0
                                ]
                            );
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
                        $prasat = Prasat::updateOrCreate(
                            [
                                'pengajuan_id' => $pengajuan->id,
                                'nama_prasat' => $value,
                                'type' => 'pengajuan'
                            ]
                        );
    
                        $gambarName = null;
                        if (isset($request->gambar[$key]) && $request->gambar[$key]) {
                            $gambar = $request->file('gambar')[$key];
                            $gambarName = time() . '_' . $gambar->getClientOriginalName();
                            $gambar->storeAs('upload/gambar', $gambarName);
                        }
    
                        PengajuanBarangLainya::updateOrCreate(
                            [
                                'prasat_id' => $prasat->id,
                                'nama_barang' => $request->nama_barang_lain[$key]
                            ],
                            [
                                'jumlah' => $request->jumlah_barang_lain[$key],
                                'estimasi_harga' => $request->estimasi_harga_barang_lain[$key],
                                'gambar' => $gambarName
                            ]
                        );
                    }
                }
            }
    
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    
        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan updated successfully');
    }
    

    public function destroy($id)
    {
        $pengajuan = Pengajuan::find($id);
    
        if (!$pengajuan) {
            return response()->json(['success' => false, 'message' => 'Pengajuan not found'], 404);
        }
    
        $pengajuan->delete();
        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan deleted successfully'); 
    }

    public function form()
    {
        $barangs = Barang::all();
        $matakuliahs = Matakuliah::all();
        return view('pengajuan.form', compact('barangs','matakuliahs'));
    }

        public function download($id)
        {
            $pengajuan = Pengajuan::find($id);
        
            if (!$pengajuan) {
                return response()->json(['success' => false, 'message' => 'Pengajuan not found'], 404);
            }
        
            return pdf()->view('pengajuan.download',compact('pengajuan'))->download();
        
    }
}


