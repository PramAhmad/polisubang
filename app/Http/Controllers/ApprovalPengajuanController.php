<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class ApprovalPengajuanController extends Controller
{
    public function approve(Request $request,$id){
        $request->validate([
            'status' => 'required|in:approved,reject',
        ]);
        Pengajuan::find($id)->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan ?? '',
        ]);
        return redirect()->back()->with('success','Pengajuan berhasil diupdate');
    }
}
