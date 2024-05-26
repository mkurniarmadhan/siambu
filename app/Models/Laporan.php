<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
