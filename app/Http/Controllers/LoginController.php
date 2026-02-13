<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'cabang'   => 'required',
            'role'     => 'required',
        ]);

        $user = User::where('name', $request->username)->first();

        if ($user) {
            // Cek Cabang
            if ($user->cabang !== $request->cabang) {
                return back()->withErrors(['username' => "Akun tidak terdaftar untuk cabang {$request->cabang}!"])->withInput();
            }

            // Cek Role
            // Khusus untuk OM, kita izinkan jika user di DB punya role 'OM' atau 'Admin'
            if ($request->role === 'OM') {
                if (!in_array($user->role, ['OM', 'Admin'])) {
                    return back()->withErrors(['username' => "Akses ditolak! Anda bukan OM/Admin."])->withInput();
                }
            } else {
                // Untuk BM dan SH harus tepat sama
                if ($user->role !== $request->role) {
                    return back()->withErrors(['username' => "Akses ditolak! Role Anda bukan {$request->role}."])->withInput();
                }
            }
        }

        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['username' => 'Username atau Password salah!'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
