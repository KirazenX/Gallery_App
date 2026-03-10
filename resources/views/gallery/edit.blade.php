@extends('layouts.app')

@section('title', 'Edit Foto')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="fa fa-edit me-2"></i>Edit Foto</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('gallery.update', $foto->FotoID) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Foto <span class="text-danger">*</span></label>
                        <input type="text" name="JudulFoto"
                               class="form-control @error('JudulFoto') is-invalid @enderror"
                               value="{{ old('JudulFoto', $foto->JudulFoto) }}" required>
                        @error('JudulFoto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="DeskripsiFoto" class="form-control" rows="3">{{ old('DeskripsiFoto', $foto->DeskripsiFoto) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Album (Opsional)</label>
                        <select name="AlbumID" class="form-select">
                            <option value="">-- Tanpa Album --</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->AlbumID }}"
                                    {{ old('AlbumID', $foto->AlbumID) == $album->AlbumID ? 'selected' : '' }}>
                                    {{ $album->NamaAlbum }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto Saat Ini</label>
                        <div>
                            <img src="{{ Storage::url($foto->LokasiFile) }}"
                                 class="img-thumbnail" style="max-height: 180px;">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Ganti Foto (Opsional)</label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                               accept="image/*" onchange="previewFoto(this)">
                        @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <img id="preview" src="#" class="img-fluid rounded mt-2 d-none" style="max-height: 200px;">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="fa fa-save me-1"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('gallery.show', $foto->FotoID) }}" class="btn btn-outline-secondary">Batal</a>
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