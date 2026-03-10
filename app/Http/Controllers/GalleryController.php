<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use App\Models\KomentarFoto;
use App\Models\LikeFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Tampilkan semua foto
    public function index()
    {
        $fotos = Foto::with(['user', 'album', 'likes'])->latest()->paginate(12);
        return view('gallery.index', compact('fotos'));
    }

    // Form tambah foto
    public function create()
    {
        $albums = Album::where('UserID', Auth::id())->get();
        return view('gallery.create', compact('albums'));
    }

    // Simpan foto baru
    public function store(Request $request)
    {
        $request->validate([
            'JudulFoto'     => 'required|string|max:255',
            'DeskripsiFoto' => 'nullable|string',
            'foto'          => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'AlbumID'       => 'nullable|exists:gallery_album,AlbumID',
        ]);

        $path = $request->file('foto')->store('fotos', 'public');

        Foto::create([
            'JudulFoto'     => $request->JudulFoto,
            'DeskripsiFoto' => $request->DeskripsiFoto,
            'TanggalUnggah' => now()->toDateString(),
            'LokasiFile'    => $path,
            'AlbumID'       => $request->AlbumID,
            'UserID'        => Auth::id(),
        ]);

        return redirect()->route('gallery.index')->with('success', 'Foto berhasil diunggah!');
    }

    // Detail foto
    public function show($id)
    {
        $foto = Foto::with(['user', 'album', 'komentars.user', 'likes'])->findOrFail($id);
        $sudahLike = LikeFoto::where('FotoID', $id)->where('UserID', Auth::id())->exists();
        return view('gallery.show', compact('foto', 'sudahLike'));
    }

    // Form edit foto (hanya pemilik foto)
    public function edit($id)
    {
        $foto = Foto::where('FotoID', $id)->where('UserID', Auth::id())->firstOrFail();
        $albums = Album::where('UserID', Auth::id())->get();
        return view('gallery.edit', compact('foto', 'albums'));
    }

    // Simpan perubahan foto
    public function update(Request $request, $id)
    {
        $foto = Foto::where('FotoID', $id)->where('UserID', Auth::id())->firstOrFail();

        $request->validate([
            'JudulFoto'     => 'required|string|max:255',
            'DeskripsiFoto' => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'AlbumID'       => 'nullable|exists:gallery_album,AlbumID',
        ]);

        // Ganti file foto jika ada upload baru
        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($foto->LokasiFile);
            $path = $request->file('foto')->store('fotos', 'public');
            $foto->LokasiFile = $path;
        }

        $foto->JudulFoto     = $request->JudulFoto;
        $foto->DeskripsiFoto = $request->DeskripsiFoto;
        $foto->AlbumID       = $request->AlbumID;
        $foto->save();

        return redirect()->route('gallery.show', $foto->FotoID)->with('success', 'Foto berhasil diperbarui!');
    }

    // Hapus foto — HANYA ADMIN
    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);
        Storage::disk('public')->delete($foto->LokasiFile);
        $foto->delete();
        return redirect()->route('gallery.index')->with('success', 'Foto berhasil dihapus.');
    }

    // Tambah komentar
    public function komentar(Request $request, $id)
    {
        $request->validate(['IsiKomentar' => 'required|string|max:500']);

        KomentarFoto::create([
            'FotoID'          => $id,
            'UserID'          => Auth::id(),
            'IsiKomentar'     => $request->IsiKomentar,
            'TanggalKomentar' => now()->toDateString(),
        ]);

        return back()->with('success', 'Komentar ditambahkan.');
    }

    // Toggle like
    public function like($id)
    {
        $existing = LikeFoto::where('FotoID', $id)->where('UserID', Auth::id())->first();

        if ($existing) {
            $existing->delete();
        } else {
            LikeFoto::create([
                'FotoID'      => $id,
                'UserID'      => Auth::id(),
                'TanggalLike' => now()->toDateString(),
            ]);
        }

        return back();
    }
}