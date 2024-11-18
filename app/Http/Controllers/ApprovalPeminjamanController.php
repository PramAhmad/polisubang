<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ApprovalPeminjamanController extends Controller
{
    public function approve(Request $request ,$id)
    {
        $request->validate([
            'status' => 'required|in:approved,reject',
        ]);
        Peminjaman::find($id)->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan ?? '',
        ]);
    }
}
