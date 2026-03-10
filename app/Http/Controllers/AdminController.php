<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\User;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalFoto  = Foto::count();
        $totalUser  = User::where('role', 'user')->count();
        $totalAlbum = Album::count();
        $fotoTerbaru = Foto::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalFoto', 'totalUser', 'totalAlbum', 'fotoTerbaru'));
    }

    public function fotos()
    {
        $fotos = Foto::with(['user', 'album'])->latest()->paginate(15);
        return view('admin.fotos', compact('fotos'));
    }

    public function destroyFoto($id)
    {
        $foto = Foto::findOrFail($id);
        Storage::disk('public')->delete($foto->LokasiFile);
        $foto->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function users()
    {
        $users = User::where('role', 'user')->withCount('fotos')->latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function destroyUser($id)
    {
        $user = User::where('UserID', $id)->where('role', 'user')->firstOrFail();
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}