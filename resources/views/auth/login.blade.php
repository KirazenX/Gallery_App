<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Galeri Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1a1a2e, #16213e); min-height: 100vh; display: flex; align-items: center; }
        .card { border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .btn-primary { background: linear-gradient(135deg, #667eea, #764ba2); border: none; }
        .brand-title { font-size: 2rem; font-weight: 700; color: #667eea; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="brand-title"><i class="fa fa-images"></i></div>
                        <h4 class="fw-bold mt-2">Galeri Foto</h4>
                        <p class="text-muted small">Masuk ke akun Anda</p>
                    </div>

                    @if($errors->has('login'))
                        <div class="alert alert-danger">{{ $errors->first('login') }}</div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text" name="Username" class="form-control @error('Username') is-invalid @enderror"
                                   placeholder="Masukkan username" value="{{ old('Username') }}" required>
                            @error('Username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="Password" class="form-control" placeholder="Masukkan password" required>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Masuk</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <span class="text-muted small">Belum punya akun? </span>
                        <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Daftar di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</body>
</html>