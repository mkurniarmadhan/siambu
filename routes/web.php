<?php

use App\Http\Controllers\AduanController;
use App\Http\Controllers\UserController;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Halaman utama
Route::view('/', 'home')->name('home');




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


    // Halaman Tentang Kami
    Route::view('tentang', 'tentang')->name('tentang');

    // Halaman Aduan
    Route::get('user-aduan', [UserController::class, 'aduanUser'])->name('user.aduan');
    Route::get('detail-aduan-user/{laporan}', [UserController::class, 'aduanDetail'])->name('user.aduan.detail');

    // Halaman dan CTA Aduan
    Route::get('buat-aduan', [AduanController::class, 'buatAduan'])->name('buat.aduan');
    Route::post('simpan-aduan', [AduanController::class, 'simpanDataAduan'])->name('simpan.data.aduan');
    Route::post('update-aduan/{laporan}', [AduanController::class, 'updateDataAduan'])->name('update.data.aduan');


    // CTA Logout
    Route::post('keluar', [UserController::class, 'keluar'])->name('keluar');
});





//  CTA cek aduan
Route::get('cek-aduan', function (Request  $request) {
    // $laporan = Laporan::find($request->kode_laporan);
    // if ($laporan != null) {
    //     return to_route('cek.aduan', $request->kode_laporan);
    // }
    // return back();


    $kodeLaporan = $request->get('kode_laporan');

    $laporan = Laporan::where('kode_laporan', $kodeLaporan)->first();

    if ($laporan) {
        return response()->json(['data' => $laporan]);
    }

    return response()->json(['data' => null], 404);
})->name('cek.aduan.post');




// Halaman cek detail aduan
Route::get('/cek-aduan/{laporan}', function (Laporan $laporan) {
    return view('aduan.cek-aduan', compact('laporan'));
})->name('cek.aduan');


// CTA dan Halaman Autentikasi
Route::get('login', [UserController::class, 'loginUser'])->name('user.login')->middleware('guest');
Route::post('user-login', [UserController::class, 'cekLogin'])->name('cek.login.user')->middleware('guest');
Route::get('register', [UserController::class, 'registerUser'])->name('user.register')->middleware('guest');
Route::post('user-register', [UserController::class, 'simpanDataUser'])->name('simpan.data.user')->middleware('guest');
