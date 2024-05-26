<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function loginUser()
    {

        return view('user.login-user');
    }

    public function cekLogin(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);



        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function registerUser()
    {

        return view('user.register-user');
    }

    public function  keluar(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return to_route('home');
    }

    public function simpanDataUser(Request $request)
    {

        $request->validate([
            'nim' => ['required'],
            'namalengkap' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = User::create([
            'nim' => $request->nim,
            'namalengkap' => $request->namalengkap,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return to_route('user.aduan');
    }



    public function aduanUser()
    {
        $dataLaporan = Laporan::all();

        if (auth()->user()->role != 'admin') {
            $dataLaporan = Laporan::where('user_id', Auth::id())->get();
        }

        return view('user.aduan-user', compact('dataLaporan'));
    }


    public function aduanDetail(Laporan $laporan)
    {

        return view('user.detail-aduan-user', compact('laporan'));
    }
}
