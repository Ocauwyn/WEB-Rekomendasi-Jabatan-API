@extends('layouts.app')

@section('title', 'Dokumentasi API - Rekomendasi Jabatan')

@section('content')
<section class="api-docs-section">
    <h2>Panduan Penggunaan API Rekomendasi Jabatan</h2>
    <p>Selamat datang di panduan penggunaan API kami. API ini memungkinkan Anda mengintegrasikan fitur rekomendasi jabatan ke dalam aplikasi dengan mudah dan efisien.</p>

    {{-- URL Dasar --}}
    <h3 class="api-heading">1. URL Dasar API</h3>
    <p>Semua permintaan ditujukan ke URL dasar berikut:</p>
    <pre><code class="code-block">http://localhost:8080</code></pre>

    {{-- Generate API Key --}}
    <h3 class="api-heading">2. Generate API Key</h3>
    <p>Untuk menggunakan API Rekomendasi Jabatan, Anda memerlukan API Key. Anda dapat menghasilkan API Key baru dengan melakukan permintaan ke endpoint berikut:</p>

    <h4 class="api-subheading">A. Generate API Key</h4>
    <ul>
        <li><strong>Deskripsi:</strong> Menghasilkan API Key baru.</li>
        <li><strong>Metode:</strong> <code class="code-inline">GET</code></li>
        <li><strong>URL:</strong> <code class="code-inline">/auth/generate-key</code></li>
        <li><strong>Contoh Permintaan:</strong></li>
        <pre><code class="code-block">curl -X GET http://localhost:8080/auth/generate-key</code></pre>
        <li><strong>Contoh Respon (JSON):</strong></li>
        <pre><code class="code-block json-code">{
    "apiKey": "your_generated_api_key_here"
}</code></pre>
    </ul>

    {{-- Endpoint --}}
    <h3 class="api-heading">3. Endpoint Tersedia</h3>

    <h4 class="api-subheading">A. Rekomendasi Jabatan</h4>
    <ul>
        <li><strong>Deskripsi:</strong> Mendapatkan rekomendasi jabatan berdasarkan data profil kandidat.</li>
        <li><strong>Metode:</strong> <code class="code-inline">POST</code></li>
        <li><strong>URL:</strong> <code class="code-inline">/rekomendasi</code></li>
        <li><strong>Header:</strong>
            <ul>
                <li><code class="code-inline">Content-Type</code>: <code class="code-inline">application/json</code></li>
                <li><code class="code-inline">x-api-key</code>: <code class="code-inline">84019f550b6a25998452b485292df3320fc4f0b9c03b71256b07377a6a94a81f</code> (API Key Anda)</li>
            </ul>
        </li>
        <li><strong>Body (JSON):</strong>
            <pre><code class="code-block json-code">{
    "nama": "string",
    "pengalaman": "number (tahun)",
    "kinerja": "number (0-100)",
    "pendidikan": "string (IT, manajemen, teknik)",
    "sertifikasi": "string (pisahkan dengan koma)",
    "kepemimpinan": "boolean (true/false)",
    "lamaBekerja": "number (tahun)",
    "softSkill": "string (pisahkan dengan koma)",
    "disiplin": "number (0-100)"
}</code></pre>
        </li>
        <li><strong>Contoh Permintaan:</strong></li>
        <pre><code class="code-block">curl -X POST \
  http://localhost:8080/rekomendasi \
  -H 'Content-Type: application/json' \
  -H 'x-api-key: 84019f550b6a25998452b485292df3320fc4f0b9c03b71256b07377a6a94a81f' \
  -d '{
    "nama": "Budi Santoso",
    "pengalaman": 5,
    "kinerja": 85,
    "pendidikan": "IT",
    "sertifikasi": "PMP, AWS Certified",
    "kepemimpinan": true,
    "lamaBekerja": 3,
    "softSkill": "Komunikasi, Kerja Tim",
    "disiplin": 90
  }'</code></pre>
        </li>
        <li><strong>Contoh Respon (JSON):</strong></li>        <pre><code class="code-block json-code">{
    "jabatan": "Lead Developer"
}</code></pre>    </ul>    <h4 class="api-subheading">B. Riwayat Rekomendasi</h4>    <ul>        <li><strong>Deskripsi:</strong> Mendapatkan riwayat rekomendasi jabatan yang telah dilakukan.</li>        <li><strong>Metode:</strong> <code class="code-inline">GET</code></li>        <li><strong>URL:</strong> <code class="code-inline">/rekomendasi/riwayat</code></li>        <li><strong>Header:</strong>            <ul>                <li><code class="code-inline">x-api-key</code>: <code class="code-inline">84019f550b6a25998452b485292df3320fc4f0b9c03b71256b07377a6a94a81f</code> (API Key Anda)</li>            </ul>        </li>        <li><strong>Contoh Permintaan:</strong></li>        <pre><code class="code-block">curl -X GET \
  http://localhost:8080/rekomendasi/riwayat \
  -H 'x-api-key: 84019f550b6a25998452b485292df3320fc4f0b9c03b71256b07377a6a94a81f'</code></pre>        <li><strong>Contoh Respon (JSON):</strong></li>        <pre><code class="code-block json-code">[
    {
        "id": 1,
        "nama": "Budi Santoso",
        "pengalaman": 5,
        "kinerja": 85,
        "pendidikan": "IT",
        "sertifikasi": "PMP, AWS Certified",
        "kepemimpinan": true,
        "lamaBekerja": 3,
        "softSkill": "Komunikasi, Kerja Tim",
        "disiplin": 90,
        "jabatan_rekomendasi": "Lead Developer",
        "created_at": "2024-07-21T10:00:00.000000Z",
        "updated_at": "2024-07-21T10:00:00.000000Z"
    },
    {
        "id": 2,
        "nama": "Siti Aminah",
        "pengalaman": 7,
        "kinerja": 92,
        "pendidikan": "Manajemen",
        "sertifikasi": "Manajemen Proyek",
        "kepemimpinan": false,
        "lamaBekerja": 5,
        "softSkill": "Negosiasi, Presentasi",
        "disiplin": 95,
        "jabatan_rekomendasi": "Project Manager",
        "created_at": "2024-07-20T15:30:00.000000Z",
        "updated_at": "2024-07-20T15:30:00.000000Z"
    }
]</code></pre>    </ul>

    {{-- Langkah-langkah Instalasi --}}
    <h3 class="api-heading">5. Langkah-langkah Instalasi</h3>
    <p>Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:</p>
    <ol>
        <li><strong>Clone Repositori:</strong>
            <pre><code class="code-block">git clone https://github.com/ryanmhildan/api-rekomendasi-jabatan.git
cd api-rekomendasi-jabatan</code></pre>
        </li>
        <li><strong>Instal Dependensi PHP:</strong>
            <pre><code class="code-block">composer install</code></pre>
        </li>
        <li><strong>Instal Dependensi Node.js:</strong>
            <pre><code class="code-block">npm install</code></pre>
        </li>
        <li><strong>Konfigurasi Environment:</strong>
            <p>Salin file <code class="code-inline">.env.example</code> menjadi <code class="code-inline">.env</code>:</p>
            <pre><code class="code-block">cp .env.example .env</code></pre>
            <p>Kemudian, buka file <code class="code-inline">.env</code> dan sesuaikan konfigurasi database jika diperlukan.</p>
        </li>
        <li><strong>Generate Application Key:</strong>
            <pre><code class="code-block">php artisan key:generate</code></pre>
        </li>
        <li><strong>Jalankan Migrasi Database:</strong>
            <pre><code class="code-block">php artisan migrate</code></pre>
        </li>
        <li><strong>Jalankan Server Pengembangan:</strong>
            <pre><code class="code-block">php artisan serve</code></pre>
            <p>Aplikasi akan berjalan di <code class="code-inline">http://localhost:8000</code>.</p>
        </li>
        <li><strong>Kompilasi Aset Frontend (opsional):</strong>
            <pre><code class="code-block">npm run dev</code></pre>
            <p>Untuk produksi:</p>
            <pre><code class="code-block">npm run build</code></pre>
        </li>
    </ol>

    {{-- Error Handling --}}
    <h3 class="api-heading">6. Penanganan Kesalahan</h3>
    <p>API akan mengembalikan kode status HTTP dan pesan kesalahan jika terjadi masalah:</p>
    <ul>
        <li><code class="code-inline">400 Bad Request</code>: Parameter tidak valid atau hilang.</li>
        <li><code class="code-inline">404 Not Found</code>: Endpoint tidak ditemukan.</li>
        <li><code class="code-inline">500 Internal Server Error</code>: Kesalahan server.</li>
    </ul>

    {{-- Kontak --}}
    <h3 class="api-heading">7. Kontak Dukungan</h3>
    <p>Jika ada pertanyaan lebih lanjut, hubungi kami di: <a href="ryanmhildan@gmail.com" class="text-blue-500 underline">ryanmhildan@gmail.com</a></p>

    <h3 class="api-heading">8. Repositori GitHub</h3>
    <p>Anda dapat menemukan kode sumber API ini di repositori GitHub berikut: <a href="https://github.com/ryanmhildan/api-rekomendasi-jabatan.git" class="text-blue-500 underline" target="_blank">https://github.com/ryanmhildan/api-rekomendasi-jabatan.git</a></p>
</section>
@endsection
