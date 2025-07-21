<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Platform Rekomendasi Jabatan')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1>Platform Rekomendasi Jabatan</h1>
            <nav class="main-nav">
                <ul>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a href="{{ route('rekomendasi.form') }}">Uji Coba</a></li>
                    <li><a href="{{ route('api.docs') }}">Dokumentasi API</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        {{-- Pesan error/sukses dari session, jika ada --}}
        @if (session('error'))
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content') {{-- Ini adalah tempat konten dari halaman lain akan disuntikkan --}}
    </main>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Platform Rekomendasi Jabatan. Hak Cipta Dilindungi.</p>
        </div>
    </footer>
</body>
</html>