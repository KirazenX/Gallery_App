@extends('layouts.app')

@section('title', 'Beranda Galeri')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fa fa-images me-2 text-primary"></i>Semua Foto</h4>
    <a href="{{ route('gallery.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-1"></i>Upload Foto
    </a>
</div>

@if($fotos->isEmpty())
    <div class="text-center py-5">
        <i class="fa fa-image fa-4x text-muted mb-3"></i>
        <p class="text-muted">Belum ada foto. Abadikan fotomu disini!</p>
        <a href="{{ route('gallery.create') }}" class="btn btn-primary">Upload Sekarang</a>
    </div>
@else
    <div class="row photo-grid g-3">
        @foreach($fotos as $foto)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm">
                <a href="{{ route('gallery.show', $foto->FotoID) }}">
                    <img src="{{ Storage::url($foto->LokasiFile) }}"
                         class="card-img-top"
                         alt="{{ $foto->JudulFoto }}">
                </a>
                <div class="card-body p-2">
                    <p class="card-title fw-semibold small mb-1 text-truncate">{{ $foto->JudulFoto }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fa fa-user me-1"></i>{{ $foto->user->Username ?? '-' }}
                        </small>
                        <small class="text-muted">
                            <i class="fa fa-heart text-danger me-1"></i>{{ $foto->likes->count() }}
                        </small>
                    </div>
                </div>
                {{-- Tombol edit hanya muncul jika foto milik user yang login --}}
@if($foto->UserID == Auth::id())
<div class="card-footer p-1 bg-transparent border-top-0">
    <a href="{{ route('gallery.edit', $foto->FotoID) }}" class="btn btn-sm btn-outline-warning w-100">
        <i class="fa fa-edit me-1"></i>Edit
    </a>
</div>
@endif

{{-- Tombol hapus hanya untuk admin --}}
@if(Auth::user()->isAdmin())
<div class="card-footer p-1 bg-transparent border-top-0">
    <form action="{{ route('admin.fotos.destroy', $foto->FotoID) }}" method="POST"
          onsubmit="return confirm('Hapus foto ini?')">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger w-100">
            <i class="fa fa-trash me-1"></i>Hapus
        </button>
    </form>
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