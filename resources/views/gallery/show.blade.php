@extends('layouts.app')

@section('title', $foto->JudulFoto)

@section('content')
<div class="row g-4">
    {{-- Kolom Foto --}}
    <div class="col-md-8">
        <div class="card shadow-sm">
            <img src="{{ Storage::url($foto->LokasiFile) }}"
                 class="card-img-top"
                 style="max-height: 500px; object-fit: contain; background: #000;"
                 alt="{{ $foto->JudulFoto }}">
            <div class="card-body">
                <h5 class="fw-bold">{{ $foto->JudulFoto }}</h5>
                <p class="text-muted">{{ $foto->DeskripsiFoto ?? 'Tidak ada deskripsi.' }}</p>
                <div class="d-flex gap-3 align-items-center text-muted small">
                    <span><i class="fa fa-user me-1"></i>{{ $foto->user->Username ?? '-' }}</span>
                    <span><i class="fa fa-calendar me-1"></i>{{ $foto->TanggalUnggah }}</span>
                    @if($foto->album)
                        <span><i class="fa fa-folder me-1"></i>{{ $foto->album->NamaAlbum }}</span>
                    @endif
                </div>
            </div>
            <div class="card-footer d-flex gap-2 flex-wrap">
    {{-- Like --}}
    <form action="{{ route('gallery.like', $foto->FotoID) }}" method="POST">
        @csrf
        <button class="btn btn-sm {{ $sudahLike ? 'btn-danger' : 'btn-outline-danger' }}">
            <i class="fa fa-heart me-1"></i>
            {{ $sudahLike ? 'Liked' : 'Like' }} ({{ $foto->likes->count() }})
        </button>
    </form>

    {{-- Tombol Edit — hanya pemilik foto --}}
    @if($foto->UserID == Auth::id())
        <a href="{{ route('gallery.edit', $foto->FotoID) }}" class="btn btn-sm btn-warning text-white">
            <i class="fa fa-edit me-1"></i>Edit Foto
        </a>
    @endif

    {{-- Tombol Hapus — HANYA ADMIN --}}
    @if(Auth::user()->isAdmin())
        <form action="{{ route('admin.fotos.destroy', $foto->FotoID) }}" method="POST"
              onsubmit="return confirm('Hapus foto ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">
                <i class="fa fa-trash me-1"></i>Hapus Foto
            </button>
        </form>
    @endif

    <a href="{{ route('gallery.index') }}" class="btn btn-sm btn-outline-secondary ms-auto">
        <i class="fa fa-arrow-left me-1"></i>Kembali
    </a>
</div>
        </div>
    </div>

    {{-- Kolom Komentar --}}
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header fw-semibold bg-light">
                <i class="fa fa-comments me-1"></i>Komentar ({{ $foto->komentars->count() }})
            </div>
            <div class="card-body" style="max-height: 350px; overflow-y: auto;">
                @forelse($foto->komentars as $komentar)
                    <div class="mb-3 pb-2 border-bottom">
                        <div class="fw-semibold small text-primary">{{ $komentar->user->Username ?? 'Anonim' }}</div>
                        <p class="mb-0 small">{{ $komentar->IsiKomentar }}</p>
                        <small class="text-muted">{{ $komentar->TanggalKomentar }}</small>
                    </div>
                @empty
                    <p class="text-muted small text-center py-3">Belum ada komentar. Jadilah yang pertama!</p>
                @endforelse
            </div>
            <div class="card-footer">
                <form action="{{ route('gallery.komentar', $foto->FotoID) }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="IsiKomentar" class="form-control form-control-sm"
                               placeholder="Tulis komentar..." required>
                        <button class="btn btn-primary btn-sm" type="submit">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </div>
                    @error('IsiKomentar')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </form>
            </div>
        </div>
    </div>
</div>
@endsection