<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f1f3f5; }
        .sidebar { min-height: 100vh; background: #1a1a2e; }
        .sidebar .nav-link { color: #adb5bd; padding: 10px 20px; border-radius: 8px; margin: 2px 10px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #667eea; color: white; }
        .sidebar .brand { color: white; font-weight: 700; font-size: 1.2rem; }
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
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <a href="{{ route('admin.fotos') }}" class="nav-link">
                <i class="fa fa-images me-2"></i>Kelola Foto
            </a>
            <a href="{{ route('admin.users') }}" class="nav-link active">
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
        <h4 class="fw-bold mb-4"><i class="fa fa-users me-2"></i>Kelola Semua User</h4>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Jumlah Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $i => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $i }}</td>
                            <td class="fw-semibold">{{ $user->Username }}</td>
                            <td>{{ $user->NamaLengkap ?? '-' }}</td>
                            <td>{{ $user->Email }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $user->fotos_count }} foto</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.users.destroy', $user->UserID) }}" method="POST"
                                      onsubmit="return confirm('Hapus user {{ $user->Username }}? Semua fotonya juga akan terhapus.')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada user terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>