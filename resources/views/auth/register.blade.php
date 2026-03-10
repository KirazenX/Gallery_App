<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Galeri Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1a1a2e, #16213e); min-height: 100vh; display: flex; align-items: center; padding: 30px 0; }
        .card { border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .btn-success { background: linear-gradient(135deg, #11998e, #38ef7d); border: none; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold">Buat Akun Baru</h4>
                        <p class="text-muted small">Bergabung dengan Galeri Foto</p>
                    </div>

                    <form action="{{ route('register.post') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                                <input type="text" name="Username" class="form-control @error('Username') is-invalid @enderror"
                                       value="{{ old('Username') }}" required>
                                @error('Username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" name="Email" class="form-control @error('Email') is-invalid @enderror"
                                       value="{{ old('Email') }}" required>
                                @error('Email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="NamaLengkap" class="form-control" value="{{ old('NamaLengkap') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="Alamat" class="form-control" rows="2">{{ old('Alamat') }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                                <input type="password" name="Password" class="form-control @error('Password') is-invalid @enderror" required>
                                @error('Password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" name="Password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-success btn-lg">Daftar Sekarang</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <span class="text-muted small">Sudah punya akun? </span>
                        <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Login di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>