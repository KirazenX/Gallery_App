@extends('layouts.app')

@section('title', 'Album Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fa fa-folder me-2 text-warning"></i>Album Saya</h4>
    <a href="{{ route('album.create') }}" class="btn btn-warning text-white">
        <i class="fa fa-plus me-1"></i>Buat Album
    </a>
</div>

@if($albums->isEmpty())
    <div class="text-center py-5">
        <i class="fa fa-folder-open fa-4x text-muted mb-3"></i>
        <p class="text-muted">Belum ada album. Buat album untuk mengorganisir fotomu!</p>
        <a href="{{ route('album.create') }}" class="btn btn-warning text-white">Buat Album</a>
    </div>
@else
    <div class="row g-3">
        @foreach($albums as $album)
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
    <h5 class="fw-bold">
        <a href="{{ route('album.show', $album->AlbumID) }}" class="text-decoration-none text-dark">
            <i class="fa fa-folder text-warning me-2"></i>{{ $album->NamaAlbum }}
        </a>
    </h5>
    <p class="text-muted small">{{ $album->Deskripsi ?? 'Tidak ada deskripsi.' }}</p>
    <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">
            <i class="fa fa-image me-1"></i>{{ $album->fotos_count }} foto
        </small>
        <small class="text-muted">
            <i class="fa fa-calendar me-1"></i>{{ $album->TanggalDibuat }}
        </small>
    </div>
</div>
                <div class="card-footer bg-transparent d-flex gap-2">
    <a href="{{ route('album.edit', $album->AlbumID) }}" class="btn btn-sm btn-warning text-white w-50">
        <i class="fa fa-edit me-1"></i>Edit
    </a>
    <form action="{{ route('album.destroy', $album->AlbumID) }}" method="POST"
          onsubmit="return confirm('Hapus album ini?')" class="w-50">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger w-100">
            <i class="fa fa-trash me-1"></i>Hapus
        </button>
    </form>
</div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection