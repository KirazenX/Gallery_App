<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Galeri Foto')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 700; letter-spacing: 1px; }
        .card-img-top { height: 200px; object-fit: cover; }
        .photo-grid img { cursor: pointer; transition: transform .2s; }
        .photo-grid img:hover { transform: scale(1.02); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('gallery.index') }}">
            <i class="fa fa-images me-2"></i>Galeri Foto
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            @auth
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gallery.index') }}"><i class="fa fa-home me-1"></i>Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gallery.create') }}"><i class="fa fa-upload me-1"></i>Upload Foto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('album.index') }}"><i class="fa fa-folder me-1"></i>Album Saya</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="fa fa-user-circle me-1"></i>{{ Auth::user()->Username }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit">
                                    <i class="fa fa-sign-out-alt me-1"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>

<div class="container mt-4">
    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa fa-check-circle me-1"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fa fa-exclamation-circle me-1"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>