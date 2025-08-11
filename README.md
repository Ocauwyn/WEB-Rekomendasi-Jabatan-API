# WEB Rekomendasi Jabatan API & Website

**Solusi Cerdas Penempatan SDM** — Sistem ini terdiri dari **API Rekomendasi Jabatan** dan **Website berbasis Laravel** yang memberikan rekomendasi jabatan terbaik bagi individu berdasarkan **data kompetensi, pengalaman, dan preferensi**.  
API dibangun dengan pendekatan **Platform as a Service (PaaS)** dan teknologi cloud untuk efisiensi, skalabilitas, serta kemudahan integrasi. Website Laravel digunakan sebagai **frontend** untuk mengelola data, menampilkan hasil rekomendasi, serta menyediakan dokumentasi dan uji coba API.

---

## 🖥️ Website Laravel

- **Framework**: Laravel 11  
- **Fitur Website**:
  1. **Beranda** — Menampilkan deskripsi singkat sistem dan manfaatnya.  
  2. **Uji Coba API** — Form untuk mengirim data kompetensi, pengalaman, dan minat, lalu menampilkan rekomendasi jabatan langsung dari API.  
  3. **Dokumentasi API** — Panduan lengkap endpoint, parameter, contoh request/response JSON, dan cara mendapatkan API Key.  
  4. CRUD data kandidat dan jabatan.  
  5. Dashboard untuk HR.  
  6. Autentikasi pengguna.  

- **Integrasi API**: Website mengirim data ke API Rekomendasi Jabatan dan menampilkan daftar jabatan yang direkomendasikan.

---

## 🚀 Fitur Utama API

- **Input Data**: Kompetensi, pengalaman, dan minat kandidat.  
- **Output Rekomendasi**: Daftar jabatan yang sesuai menggunakan model machine learning.  
- **API Key**: Sistem autentikasi dengan API Key.  
- **Riwayat Rekomendasi**: Menyimpan hasil rekomendasi untuk analisis lebih lanjut.  

---

## 🎯 Manfaat

1. Mempermudah HR dalam penempatan karyawan.  
2. Meningkatkan akurasi penugasan jabatan.  
3. Mendukung perencanaan karier karyawan.  
4. Mengoptimalkan pemanfaatan SDM.  
5. Meningkatkan kepuasan dan retensi karyawan.  
6. Skalabilitas dan ketersediaan tinggi.  

---

## 🛠 Arsitektur Sistem

![Diagram Arsitektur](arsitektur_rekomendasi_jabatan.png)

- **Website Laravel** — frontend dan manajemen data  
- **Docker & Docker Compose** — orkestrasi dan deployment  
- **NGINX** — API Gateway  
- **Microservices**:  
  - `auth-service` → Menghasilkan & mengelola API Key  
  - `rekomendasi-service` → Menghitung & menyimpan hasil rekomendasi jabatan  
- **MongoDB** — Penyimpanan data kandidat & histori rekomendasi  
- **Cloud Platform** — Contoh: Google App Engine, Microsoft Azure App Service, Heroku, AWS Elastic Beanstalk  

---

## ⚙️ Cara Menjalankan (Local Development)

## 📦 Endpoint API

### 🔐 AUTH SERVICE

#### `GET /auth/generate-key`

- **Deskripsi**: Menghasilkan API Key unik yang digunakan untuk mengakses layanan rekomendasi.
- **Respons**:
  ```json
  {
    "apiKey": "xxxxxxxxxxxxxxxxxx"
  }
  ```

---

### 🧠 REKOMENDASI SERVICE

> Semua endpoint pada layanan ini membutuhkan header `x-api-key` dengan API Key yang valid.

#### `POST /rekomendasi`

- **Deskripsi**: Mendapatkan rekomendasi jabatan berdasarkan input data kandidat.
- **Header**:
  ```
  x-api-key: <API_KEY>
  ```
- **Body JSON**:
  ```json
  {
    "nama": "Budi",
    "pengalaman": 5,
    "kinerja": 85,
    "pendidikan": "IT",
    "sertifikasi": ["Project Management"],
    "kepemimpinan": true,
    "lamaBekerja": 4,
    "softSkill": ["Komunikasi"],
    "disiplin": 80
  }
  ```
- **Respons**:
  ```json
  {
    "jabatan": "Lead Developer"
  }
  ```

---

#### `GET /rekomendasi/riwayat`

- **Deskripsi**: Melihat histori hasil rekomendasi berdasarkan API Key.
- **Query Opsional**:
  - `nama`: Filter berdasarkan nama kandidat
  - `tanggalMulai`, `tanggalAkhir`: Filter berdasarkan rentang tanggal (format `YYYY-MM-DD`)
- **Contoh**:
  ```
  GET /rekomendasi/riwayat?nama=Budi&tanggalMulai=2025-06-01&tanggalAkhir=2025-06-30
  ```
- **Respons**:
  ```json
  [
    {
      "nama": "Budi",
      "hasilRekomendasi": "Lead Developer",
      ...
    }
  ]
  ```

---

## ⚙️ Menjalankan di Lokal

1. Jalankan perintah:
   ```bash
   docker-compose up --build
   ```

2. Akses layanan melalui browser atau Postman:

   - 🔑 Generate API Key:  
     [http://localhost:8080/auth/generate-key](http://localhost:8080/auth/generate-key)

   - 🧠 Hitung Rekomendasi:  
     `POST` [http://localhost:8080/rekomendasi](http://localhost:8080/rekomendasi)

   - 📊 Cek Riwayat:  
     `GET` [http://localhost:8080/rekomendasi/riwayat](http://localhost:8080/rekomendasi/riwayat)

---

## 📂 Sumber Kode API
Anda dapat menemukan kode sumber API ini di repositori GitHub berikut:
🔗 API Rekomendasi Jabatan – GitHub : https://github.com/Ocauwyn/API-Rekomendasi-Jabatan

## 📸 Contoh Tampilan Website
### Beranda
![Beranda](screenshots/1.PNG)

### Uji Coba
![Uji Coba](screenshots/2.PNG)

### Dokumentasi API
![Dokumentasi API](3.PNG)

