<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Pastikan model User di-import

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input awal
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'cabang' => 'required', // Tambahkan validasi cabang wajib diisi
        ]);

        // 2. Cek apakah User dengan nama tersebut ada dan apakah cabangnya sesuai
        $user = User::where('name', $request->name)->first();

        if ($user) {
            if ($user->cabang !== $request->cabang) {
                // Jika user ada tapi cabang salah, kirim alert error khusus
                return back()->withErrors([
                    'name' => "Maaf, akun {$request->name} tidak terdaftar untuk cabang {$request->cabang}!"
                ])->withInput();
            }
        }

    
        if (Auth::attempt($request->only('name', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['name' => 'Nama atau Password salah!'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
