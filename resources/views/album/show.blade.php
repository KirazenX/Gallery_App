@extends('layouts.app')

@section('title', $album->NamaAlbum)

@section('content')

<div class="card shadow-sm mb-4 border-0" style="background: linear-gradient(135deg, #667eea, #764ba2);">
    <div class="card-body p-4 text-white">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
                <div class="mb-1">
                    <a href="{{ route('album.index') }}" class="text-white text-decoration-none opacity-75">
                        <i class="fa fa-arrow-left me-1"></i>Kembali ke Daftar Album
                    </a>
                </div>
                <h3 class="fw-bold mb-1">
                    <i class="fa fa-folder-open me-2"></i>{{ $album->NamaAlbum }}
                </h3>
                <p class="mb-2 opacity-75">{{ $album->Deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                <div class="d-flex gap-3 small opacity-75">
                    <span><i class="fa fa-calendar me-1"></i>Dibuat {{ $album->TanggalDibuat }}</span>
                    <span><i class="fa fa-image me-1"></i>{{ $fotos->total() }} foto</span>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('album.edit', $album->AlbumID) }}" class="btn btn-light btn-sm">
                    <i class="fa fa-edit me-1"></i>Edit Album
                </a>
                <form action="{{ route('album.destroy', $album->AlbumID) }}" method="POST"
                      onsubmit="return confirm('Hapus album ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-light btn-sm">
                        <i class="fa fa-trash me-1"></i>Hapus Album
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0">Foto dalam Album</h5>
    <a href="{{ route('gallery.create') }}?album={{ $album->AlbumID }}" class="btn btn-primary btn-sm">
        <i class="fa fa-plus me-1"></i>Upload ke Album Ini
    </a>
</div>

@if($fotos->isEmpty())
    <div class="text-center py-5">
        <i class="fa fa-images fa-4x text-muted mb-3 d-block"></i>
        <p class="text-muted">Belum ada foto di album ini.</p>
        <a href="{{ route('gallery.create') }}" class="btn btn-primary">
            <i class="fa fa-upload me-1"></i>Upload Foto Sekarang
        </a>
    </div>
@else
    <div class="row g-3">
        @foreach($fotos as $foto)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm border-0">
                <a href="{{ route('gallery.show', $foto->FotoID) }}">
                    <img src="{{ Storage::url($foto->LokasiFile) }}"
                         class="card-img-top"
                         style="height: 180px; object-fit: cover;"
                         alt="{{ $foto->JudulFoto }}">
                </a>
                <div class="card-body p-2">
                    <p class="fw-semibold small mb-1 text-truncate" title="{{ $foto->JudulFoto }}">
                        {{ $foto->JudulFoto }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fa fa-calendar me-1"></i>{{ $foto->TanggalUnggah }}
                        </small>
                        <small class="text-muted">
                            <i class="fa fa-heart text-danger me-1"></i>{{ $foto->likes->count() }}
                        </small>
                    </div>
                </div>

                @if($foto->UserID == Auth::id() || Auth::user()->isAdmin())
                <div class="card-footer p-1 bg-transparent d-flex gap-1">
                    @if($foto->UserID == Auth::id())
                        <a href="{{ route('gallery.edit', $foto->FotoID) }}"
                           class="btn btn-sm btn-outline-warning flex-fill">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endif
                    @if(Auth::user()->isAdmin())
                        <form action="{{ route('admin.fotos.destroy', $foto->FotoID) }}" method="POST"
                              onsubmit="return confirm('Hapus foto ini?')" class="flex-fill">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger w-100">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    @endif
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $fotos->links() }}
    </div>
@endif

@endsection