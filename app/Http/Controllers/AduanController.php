<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AduanController extends Controller
{

    public function listAduan()
    {

        return view('aduan.list-aduan');
    }



    public function buatAduan()
    {

        $kodeLaporan = Laporan::generateKodeLaporan();


        return view('aduan.buat-aduan', compact('kodeLaporan'));
    }

    public  function simpanDataAduan(Request $request)
    {

        if ($file = $request->file('lampiran_laporan')) {
            $lampiran = $request->kode_laporan . '.' . $file->getClientOriginalExtension();
            $request->file('lampiran_laporan')->move(public_path('foto_lampiran'), $lampiran);
        }



        Laporan::create(
            [
                'kode_laporan' => $request->kode_laporan,
                'judul_laporan' => $request->judul_laporan,
                'isi_laporan' => $request->isi_laporan,
                'lampiran_laporan' => $lampiran ?? null,
                'jenis_laporan' => $request->jenis_laporan,
                'user_id' => Auth::id()
            ]
        );

        return to_route('user.aduan');
    }




    public  function updateDataAduan(Laporan $laporan, Request $request)
    {

        $laporan->status_laporan = $request->status_laporan ? 1 : 0;
        $laporan->tanggapan_laporan = $request->tanggapan_laporan;
        $laporan->save();

        return to_route('user.aduan.detail', $laporan);
    }
}
