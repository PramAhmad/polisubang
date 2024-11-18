<?php

namespace App\Http\Controllers;

use App\DataTables\MatakuliahDataTable;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MatakuliahController extends Controller
{
    public function index(MatakuliahDataTable $datatable)
    {
        return $datatable->render('matakuliah.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|min:1|max:100',
            'name' => 'required|min:3|max:100',
        ],[
            'kode_matakuliah.required' => 'Kode matakuliah wajib diisi.',
            'kode_matakuliah.min' => 'Kode matakuliah minimal 1 karakter.',
            'kode_matakuliah.max' => 'Kode matakuliah maksimal 100 karakter.',
            'name.required' => 'Nama matakuliah wajib diisi.',
            'name.min' => 'Nama matakuliah minimal 3 karakter.',
            'name.max' => 'Nama matakuliah maksimal 100 karakter.',
        ]);

        Matakuliah::create($request->all());

        return response()->json(['success' => true, 'message' => 'Matakuliah created successfully', '_token' => csrf_token()]);
    }

    public function edit($id)
    {
        $matakuliah = Matakuliah::find($id);

        if (!$matakuliah) {
            return response()->json(['success' => false, 'message' => 'Matakuliah not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $matakuliah, '_token' => csrf_token()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required|min:3|max:100',
            'kode_matakuliah' => 'required|min:1|max:100',
        ],[
            'name.required' => 'Nama matakuliah wajib diisi.',
            'name.min' => 'Nama matakuliah minimal 3 karakter.',
            'name.max' => 'Nama matakuliah maksimal 100 karakter.',
            'kode_matakuliah.required' => 'Kode matakuliah wajib diisi.',
            'kode_matakuliah.min' => 'Kode matakuliah minimal 1 karakter.',
            'kode_matakuliah.max' => 'Kode matakuliah maksimal 100 karakter.',
        ]);

        $matakuliah = Matakuliah::find($id);

        if (!$matakuliah) {
            return response()->json(['success' => false, 'message' => 'Matakuliah not found'], 404);
        }

        $update = $request->all();

        $matakuliah->update($update);

        return response()->json(['success' => true, 'message' => 'Matakuliah update successfully', '_token' => csrf_token()]);
    }

    public function destroy($id)
    {
        $matakuliah = Matakuliah::find($id);

        if (!$matakuliah) {
            return response()->json(['success' => true, 'message' => 'Matakuliah not found'], 404);
        }

        $matakuliah->delete();

        return response()->json(['success' => true, 'message' => 'Matakuliah deleted successfully', '_token' => csrf_token()]);
    }
}
