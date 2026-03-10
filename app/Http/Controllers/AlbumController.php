<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Foto;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::where('UserID', Auth::id())->withCount('fotos')->latest()->get();
        return view('album.index', compact('albums'));
    }

    public function create()
    {
        return view('album.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaAlbum' => 'required|string|max:255',
            'Deskripsi' => 'nullable|string',
        ]);

        Album::create([
            'NamaAlbum'     => $request->NamaAlbum,
            'Deskripsi'     => $request->Deskripsi,
            'TanggalDibuat' => now()->toDateString(),
            'UserID'        => Auth::id(),
        ]);

        return redirect()->route('album.index')->with('success', 'Album berhasil dibuat!');
    }

public function show($id)
{
    $album = Album::where('AlbumID', $id)
                  ->where('UserID', Auth::id())
                  ->firstOrFail();

    $fotos = Foto::where('AlbumID', $id)
                 ->with(['user', 'likes'])
                 ->latest()
                 ->paginate(12);

    return view('album.show', compact('album', 'fotos'));
}

    public function edit($id)
    {
        $album = Album::where('AlbumID', $id)->where('UserID', Auth::id())->firstOrFail();
        return view('album.edit', compact('album'));
    }

    public function update(Request $request, $id)
    {
        $album = Album::where('AlbumID', $id)->where('UserID', Auth::id())->firstOrFail();

        $request->validate([
            'NamaAlbum' => 'required|string|max:255',
            'Deskripsi' => 'nullable|string',
        ]);

        $album->NamaAlbum = $request->NamaAlbum;
        $album->Deskripsi = $request->Deskripsi;
        $album->save();

        return redirect()->route('album.index')->with('success', 'Album berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $album = Album::where('AlbumID', $id)->where('UserID', Auth::id())->firstOrFail();
        $album->delete();
        return redirect()->route('album.index')->with('success', 'Album berhasil dihapus.');
    }
}