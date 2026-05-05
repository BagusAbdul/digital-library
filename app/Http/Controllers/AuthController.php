<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    if (auth()->attempt($credentials)) {
        $request->session()->regenerate();

        $roleName = auth()->user()->role->nama_role;

        // Pemetaan manual agar lebih aman
        $redirectPath = match($roleName) {
            'Administrator' => 'admin.dashboard',
            'Petugas'       => 'petugas.dashboard',
            'Peminjam'      => 'peminjam.dashboard',
            default         => 'login',
        };

        return redirect()->intended(route($redirectPath));
    }

    return back()->withErrors(['loginError' => 'Username atau Password salah!']);
}

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

public function register(Request $request)
{
    $request->validate([
        'username' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'nama_lengkap' => 'required',
        'alamat' => 'required',
    ]);

    // Cari ID untuk role Peminjam
    $peminjamRole = Role::where('nama_role', 'Peminjam')->first();

    User::create([
        'role_id' => $peminjamRole->id,
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'nama_lengkap' => $request->nama_lengkap,
        'alamat' => $request->alamat,
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
}

}
