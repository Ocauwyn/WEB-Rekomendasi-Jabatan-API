<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Untuk melakukan HTTP request ke API
use Illuminate\Support\Facades\Log;   // Untuk mencatat error

class RekomendasiController extends Controller
{
    /**
     * Menampilkan form untuk mendapatkan rekomendasi jabatan.
     * Ini adalah halaman utama yang akan dilihat user.
     */
    public function showForm()
    {
        // Cukup tampilkan view form
        return view('rekomendasi-form');
    }

    /**
     * Memproses input dari form dan memanggil API Node.js.
     * Ini akan dipanggil ketika user men-submit form.
     */
    public function processRecommendation(Request $request)
    {
        // --- 1. Validasi Input dari Form Laravel ---
        // Pastikan aturan validasi ini cocok dengan data
        // yang diharapkan oleh API Node.js Anda.
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'pengalaman' => 'required|integer|min:0',
            'kinerja' => 'required|integer|min:0|max:100',
            'pendidikan' => 'required|string|in:IT,Manajemen,Teknik,Lainnya',
            'sertifikasi' => 'nullable|string|max:1000', // Akan dipecah menjadi array
            'kepemimpinan' => 'nullable|boolean', // Akan dikonversi dari checkbox
            'lamaBekerja' => 'required|integer|min:0',
            'softSkill' => 'nullable|string|max:1000', // Akan dipecah menjadi array
            'disiplin' => 'required|integer|min:0|max:100',
        ]);

        // --- 2. Persiapan Data untuk Payload API Node.js ---
        // API Node.js Anda mengharapkan 'sertifikasi' dan 'softSkill' sebagai array of strings.
        // Dari form HTML, kita akan mendapatkan mereka sebagai string yang dipisahkan koma.
        // Maka, kita perlu mengkonversinya.
        $sertifikasiArray = [];
        if (!empty($validatedData['sertifikasi'])) {
            $sertifikasiArray = array_map('trim', explode(',', $validatedData['sertifikasi']));
        }

        $softSkillArray = [];
        if (!empty($validatedData['softSkill'])) {
            $softSkillArray = array_map('trim', explode(',', $validatedData['softSkill']));
        }

        // API Node.js Anda mengharapkan 'kepemimpinan' sebagai boolean.
        // Checkbox yang dicentang akan mengirimkan 'value="true"'. Jika tidak dicentang, tidak akan ada di request.
        $kepemimpinanBoolean = $request->has('kepemimpinan') && $request->input('kepemimpinan') === 'true';

        // Bangun payload (data yang akan dikirim) dalam format yang diharapkan API Node.js
        $apiPayload = [
            'nama' => $validatedData['nama'],
            'pengalaman' => (int)$validatedData['pengalaman'], // Pastikan tipe data 'Number'
            'kinerja' => (int)$validatedData['kinerja'],       // Pastikan tipe data 'Number'
            'pendidikan' => $validatedData['pendidikan'],
            'sertifikasi' => $sertifikasiArray,
            'kepemimpinan' => $kepemimpinanBoolean,
            'lamaBekerja' => (int)$validatedData['lamaBekerja'], // Pastikan tipe data 'Number'
            'softSkill' => $softSkillArray,
            'disiplin' => (int)$validatedData['disiplin'],     // Pastikan tipe data 'Number'
        ];

        // --- 3. Panggil API Node.js ---
        $apiUrl = env('NODEJS_API_URL'); // Ambil URL dasar API dari .env Laravel

        // Cek apakah URL API sudah dikonfigurasi
        if (!$apiUrl) {
            Log::error('NODEJS_API_URL belum dikonfigurasi di file .env Laravel. Mohon periksa!');
            return back()->withInput()->with('error', 'Konfigurasi API tidak lengkap. Silakan hubungi administrator.');
        }

        try {
            $response = Http::withHeaders([
                'x-api-key' => env('API_REKOMENDASI_KEY'),
            ])->post("{$apiUrl}/rekomendasi", $apiPayload);

            if ($response->successful()) {
                $result = $response->json();
                if (isset($result['jabatan'])) {
                    return back()->with('rekomendasi', $result['jabatan'])->withInput();
                } else {
                    Log::error('Respon tidak valid: ' . $response->body());
                    return back()->withInput()->with('error', 'Respon API tidak valid.');
                }
            } else {
                $statusCode = $response->status();
                $errorMessage = $response->json('message') ?? 'Terjadi kesalahan dari API.';
                Log::error("Gagal (Status: {$statusCode}): {$errorMessage}");
                return back()->withInput()->with('error', "Gagal: [{$statusCode}] {$errorMessage}");
            }
        } catch (\Exception $e) {
            Log::error('Gagal terhubung: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Tidak bisa menghubungi API.');
        }
    }
}
