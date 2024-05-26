<?php

use App\Http\Controllers\AduanController;
use App\Http\Controllers\UserController;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $data = [
            'hariIni' => Laporan::whereDate('created_at', \Carbon\Carbon::now())->count(),
            'total' => Laporan::count(),
            'penganduan' => Laporan::where('jenis_laporan', 'pengaduan')->count(),
            'informasi' => Laporan::where('jenis_laporan', 'informasi')->count(),
            'selesai' => Laporan::where('status_laporan', 1)->count(),
            'belumSelesai' => Laporan::where('status_laporan', 0)->count()

        ];
        return view('dashboard', compact('data'));
    })->name('dashboard');

    Route::view('tentang', 'tentang')->name('tentang');


    Route::get('user-aduan', [UserController::class, 'aduanUser'])->name('user.aduan');
    Route::get('detail-aduan-user/{laporan}', [UserController::class, 'aduanDetail'])->name('user.aduan.detail');


    Route::get('buat-aduan', [AduanController::class, 'buatAduan'])->name('buat.aduan');
    Route::post('simpan-aduan', [AduanController::class, 'simpanDataAduan'])->name('simpan.data.aduan');
    Route::post('update-aduan/{laporan}', [AduanController::class, 'updateDataAduan'])->name('update.data.aduan');



    Route::post('keluar', [UserController::class, 'keluar'])->name('keluar');
});




Route::get('/', function (Laporan $laporan) {
    return view('home');
})->name('home');


Route::post('cek-aduan', function (Request  $request) {


    $laporan = Laporan::find($request->kode_laporan);
    if ($laporan != null) {

        return to_route('cek.aduan', $request->kode_laporan);
    }
    return back();
})->name('cek.aduan.post');





Route::get('/cek-aduan/{laporan}', function (Laporan $laporan) {
    return view('aduan.cek-aduan', compact('laporan'));
})->name('cek.aduan');


Route::get('login', [UserController::class, 'loginUser'])->name('user.login');
Route::post('user-login', [UserController::class, 'cekLogin'])->name('cek.login.user');
Route::get('register', [UserController::class, 'registerUser'])->name('user.register');
Route::post('user-register', [UserController::class, 'simpanDataUser'])->name('simpan.data.user');
