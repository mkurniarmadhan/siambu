<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Laporan extends Model
{
    use HasFactory;


    protected $primaryKey = 'kode_laporan';
    protected $keyType = 'string';

    protected $fillable = [
        'kode_laporan',
        'judul_laporan',
        'isi_laporan',
        'lampiran_laporan',
        'jenis_laporan',
        'status_laporan',
        'tanggapan_laporan',
        'user_id'
    ];


    public static function generateKodeLaporan()
    {
        $prefix = 'PM';
        $bulan = date('m'); // 2 digit bulan
        $tanggal = date('d'); // 2 digit tanggal

        // Hitung jumlah laporan hari ini
        $count = DB::table('laporans')
            ->whereDate('created_at', now()->toDateString())
            ->count();

        // Tambahkan 1 untuk laporan baru
        $count += 1;

        // Format dengan 3 digit prefix
        $prefixLaporan = str_pad($count, 3, '0', STR_PAD_LEFT);

        return "{$prefix}-{$bulan}{$tanggal}-{$prefixLaporan}";
    }
}
