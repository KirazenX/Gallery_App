@extends('layouts.app')

@section('title', 'Buat Album')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="fa fa-folder-plus me-2"></i>Buat Album Baru</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('album.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Album <span class="text-danger">*</span></label>
                        <input type="text" name="NamaAlbum"
                               class="form-control @error('NamaAlbum') is-invalid @enderror"
                               value="{{ old('NamaAlbum') }}" placeholder="Contoh: Liburan 2024" required>
                        @error('NamaAlbum') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="Deskripsi" class="form-control" rows="3"
                                  placeholder="Deskripsi singkat album...">{{ old('Deskripsi') }}</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="fa fa-save me-1"></i>Simpan Album
                        </button>
                        <a href="{{ route('album.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection