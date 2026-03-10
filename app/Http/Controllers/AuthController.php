<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $request->validate([
        'Username' => 'required|string',
        'Password' => 'required|string',
    ]);

    $user = User::where('Username', $request->Username)->first();

    if ($user && Hash::check($request->Password, $user->Password)) {
        Auth::login($user);

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
        }

        return redirect()->route('gallery.index')->with('success', 'Selamat datang, ' . $user->Username . '!');
    }

    return back()->withErrors(['login' => 'Username atau password salah.'])->withInput();
}

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'Username'    => 'required|string|max:255|unique:gallery_user,Username',
            'Email'       => 'required|email|max:255|unique:gallery_user,Email',
            'Password'    => 'required|string|min:6|confirmed',
            'NamaLengkap' => 'nullable|string|max:255',
            'Alamat'      => 'nullable|string',
        ]);

        $user = User::create([
            'Username'    => $request->Username,
            'Email'       => $request->Email,
            'Password'    => Hash::make($request->Password),
            'NamaLengkap' => $request->NamaLengkap,
            'Alamat'      => $request->Alamat,
        ]);

        Auth::login($user);
        return redirect()->route('gallery.index')->with('success', 'Registrasi berhasil!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}