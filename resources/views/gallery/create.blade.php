@extends('layouts.app')

@section('title', 'Upload Foto')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fa fa-upload me-2"></i>Upload Foto Baru</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Foto <span class="text-danger">*</span></label>
                        <input type="text" name="JudulFoto" class="form-control @error('JudulFoto') is-invalid @enderror"
                               value="{{ old('JudulFoto') }}" placeholder="Tulis judul foto..." required>
                        @error('JudulFoto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="DeskripsiFoto" class="form-control" rows="3"
                                  placeholder="Tambahkan deskripsi foto...">{{ old('DeskripsiFoto') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Album (Opsional)</label>
                        <select name="AlbumID" class="form-select">
                            <option value="">-- Tanpa Album --</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->AlbumID }}" {{ old('AlbumID') == $album->AlbumID ? 'selected' : '' }}>
                                    {{ $album->NamaAlbum }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">
                            Belum punya album? <a href="{{ route('album.create') }}">Buat album dulu</a>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">File Foto <span class="text-danger">*</span></label>
                        <input type="file" name="foto" id="fotoInput"
                               class="form-control @error('foto') is-invalid @enderror"
                               accept="image/*" required onchange="previewFoto(this)">
                        @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="mt-2 text-muted small">Format: JPG, PNG, GIF, WEBP. Maks: 5MB</div>
                        <img id="preview" src="#" class="img-fluid rounded mt-2 d-none" style="max-height: 250px;">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-cloud-upload-alt me-1"></i>Upload Foto
                        </button>
                        <a href="{{ route('gallery.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewFoto(input) {
        const preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection