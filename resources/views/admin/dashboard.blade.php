<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Galeri Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f1f3f5; }
        .sidebar { min-height: 100vh; background: #1a1a2e; }
        .sidebar .nav-link { color: #adb5bd; padding: 10px 20px; border-radius: 8px; margin: 2px 10px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #667eea; color: white; }
        .sidebar .brand { color: white; font-weight: 700; font-size: 1.2rem; }
        .stat-card { border: none; border-radius: 12px; }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar col-md-2 p-0">
        <div class="p-3 border-bottom border-secondary">
            <div class="brand"><i class="fa fa-images me-2"></i>Admin Panel</div>
            <small class="text-muted">{{ Auth::user()->Username }}</small>
        </div>
        <nav class="nav flex-column mt-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <a href="{{ route('admin.fotos') }}" class="nav-link">
                <i class="fa fa-images me-2"></i>Kelola Foto
            </a>
            <a href="{{ route('admin.users') }}" class="nav-link">
                <i class="fa fa-users me-2"></i>Kelola User
            </a>
            <hr class="border-secondary mx-3">
            <a href="{{ route('gallery.index') }}" class="nav-link">
                <i class="fa fa-eye me-2"></i>Lihat Galeri
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mx-3 mt-2">
                @csrf
                <button class="btn btn-outline-danger btn-sm w-100">
                    <i class="fa fa-sign-out-alt me-1"></i>Logout
                </button>
            </form>
        </nav>
    </div>

    <div class="col-md-10 p-4">
        <h4 class="fw-bold mb-4">Dashboard Admin</h4>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Stat Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card stat-card shadow-sm bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fs-2 fw-bold">{{ $totalFoto }}</div>
                            <div>Total Foto</div>
                        </div>
                        <i class="fa fa-images fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm bg-success text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fs-2 fw-bold">{{ $totalUser }}</div>
                            <div>Total User</div>
                        </div>
                        <i class="fa fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm bg-warning text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fs-2 fw-bold">{{ $totalAlbum }}</div>
                            <div>Total Album</div>
                        </div>
                        <i class="fa fa-folder fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header fw-semibold bg-white">
                <i class="fa fa-clock me-1"></i>Foto Terbaru
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Oleh</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fotoTerbaru as $foto)
                        <tr>
                            <td>
                                <img src="{{ Storage::url($foto->LokasiFile) }}"
                                     style="width:50px;height:50px;object-fit:cover;border-radius:6px;">
                            </td>
                            <td>{{ $foto->JudulFoto }}</td>
                            <td>{{ $foto->user->Username ?? '-' }}</td>
                            <td>{{ $foto->TanggalUnggah }}</td>
                            <td>
                                <form action="{{ route('admin.fotos.destroy', $foto->FotoID) }}" method="POST"
                                      onsubmit="return confirm('Hapus foto ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>