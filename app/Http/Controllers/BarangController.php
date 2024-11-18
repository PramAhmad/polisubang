<?php

namespace App\Http\Controllers;

use App\DataTables\BarangDataTable;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class BarangController extends Controller
{
    public function index(BarangDataTable $datatable)
    {
    //  update exprice to Ya jika sudah kadaluarsa
        $barang = Barang::where('tanggal_expired', '<', date('Y-m-d'))->get();
        foreach ($barang as $key => $value) {
            $value->update(['expired' => 'Ya']);
        }
        return $datatable->render('barang.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|min:1|max:100',
            'jumlah' => 'required|min:1',
            'tanggal_expired' => 'nullable|date',
            'kondisi' => 'required|string|max:255',
            'lokasi_barang' => 'required|string|max:255',
        ],[
        
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.min' => 'Nama barang minimal 1 karakter.',
            'nama_barang.max' => 'Nama barang maksimal 100 karakter.',
            'jumlah.required' => 'Jumlah barang wajib diisi.',
            'jumlah.min' => 'Jumlah barang minimal 1.',
            'tanggal_expired.date' => 'Tanggal expired harus berupa tanggal.',
            'kondisi.required' => 'Kondisi barang wajib diisi.',
            'kondisi.string' => 'Kondisi barang harus berupa string.',
            'kondisi.max' => 'Kondisi barang maksimal 255 karakter.',
            'lokasi_barang.required' => 'Lokasi barang wajib diisi.',
            'lokasi_barang.string' => 'Lokasi barang harus berupa string.',
            'lokasi_barang.max' => 'Lokasi barang maksimal 255 karakter.',
        ]);

       
        Barang::create($request->all());

        return response()->json(['success' => true, 'message' => 'Barang created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['success' => false, 'message' => 'Barang not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $barang, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|min:1|max:100',
            'jumlah' => 'required|min:1',
            'tanggal_expired' => 'nullable|date',
            'kondisi' => 'required|string|max:255',
            'lokasi_barang' => 'required|string|max:255',
        ],[
        
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.min' => 'Nama barang minimal 1 karakter.',
            'nama_barang.max' => 'Nama barang maksimal 100 karakter.',
            'jumlah.required' => 'Jumlah barang wajib diisi.',
            'jumlah.min' => 'Jumlah barang minimal 1.',
            'tanggal_expired.date' => 'Tanggal expired harus berupa tanggal.',
            'kondisi.required' => 'Kondisi barang wajib diisi.',
            'kondisi.string' => 'Kondisi barang harus berupa string.',
            'kondisi.max' => 'Kondisi barang maksimal 255 karakter.',
            'lokasi_barang.required' => 'Lokasi barang wajib diisi.',
            'lokasi_barang.string' => 'Lokasi barang harus berupa string.',
            'lokasi_barang.max' => 'Lokasi barang maksimal 255 karakter.',
        ]);
        Barang::find($id)->update($request->all());
        return response()->json(['success' => true, 'message' => 'Barang update successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['success' => true, 'message' => 'Barang not found'], 404);
        }

        $barang->delete();

        return response()->json(['success' => true, 'message' => 'Barang deleted successfully', '_token' => csrf_token()]);
    }
    public function export()
{
    $barangData = Barang::select('expired','nama_barang','jumlah','kondisi','lokasi_barang')->get(); //get selected kolom

    return FastExcel::data($barangData)->download(now().'barang.xlsx');
}
public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:xlsx,csv,xls',
    ]);

    try {
        FastExcel::import($request->file('file'), function ($line) {
            Barang::create([
                'nama_barang' => $line['nama_barang'] ?? 'Unknown',
                'jumlah' => $line['jumlah'] ?? 0,
                'expired' => $line['expired'] ?? 'tidak',
                'tanggal_expired' =>  null,
                'kondisi' => $line['kondisi'] ?? 'baik',
                'lokasi_barang' => $line['lokasi_barang'] ?? 'Unknown Location',
                'type' => $line['type'] ?? 'Default Type',
            ]);
        });

        return response()->json(['message' => 'Data has been imported successfully.'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to import data.', 'error' => $e->getMessage()], 500);
    }
}
}
