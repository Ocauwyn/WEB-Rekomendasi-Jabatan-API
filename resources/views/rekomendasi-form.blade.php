@extends('layouts.app')

@section('title', 'Dapatkan Rekomendasi Jabatan')

@section('content')
    <section class="rekomendasi-form-section">
        <h2>Dapatkan Rekomendasi Jabatan Anda</h2>
        <p>Isi formulir di bawah ini untuk mendapatkan rekomendasi jabatan berdasarkan profil Anda.</p>

        <form id="rekomendasiForm" class="rekomendasi-form">
            @csrf

            {{-- Informasi Pribadi --}}
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="pendidikan">Pendidikan Terakhir:</label>
                <select id="pendidikan" name="pendidikan" required>
                    <option value="" {{ old('pendidikan') == '' ? 'selected' : '' }}>Pilih Pendidikan</option>
                    <option value="IT" {{ old('pendidikan') == 'IT' ? 'selected' : '' }}>Teknologi Informatika</option>
                    <option value="manajemen" {{ old('pendidikan') == 'manajemen' ? 'selected' : '' }}>Manajemen</option>
                    <option value="teknik" {{ old('pendidikan') == 'teknik' ? 'selected' : '' }}>Teknik (Non-IT)</option>
                </select>
                @error('pendidikan') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            {{-- Pengalaman dan Kinerja --}}
            <div class="form-group">
                <label for="pengalaman">Pengalaman (Tahun):</label>
                <input type="number" id="pengalaman" name="pengalaman" min="0" value="{{ old('pengalaman') }}" required>
                @error('pengalaman') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="lamaBekerja">Lama Bekerja di Perusahaan Terakhir (Tahun):</label>
                <input type="number" id="lamaBekerja" name="lamaBekerja" min="0" value="{{ old('lamaBekerja') }}" required>
                @error('lamaBekerja') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="kinerja">Nilai Kinerja (0-100):</label>
                <input type="number" id="kinerja" name="kinerja" min="0" max="100" value="{{ old('kinerja') }}" required>
                @error('kinerja') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="disiplin">Nilai Disiplin (0-100):</label>
                <input type="number" id="disiplin" name="disiplin" min="0" max="100" value="{{ old('disiplin') }}" required>
                @error('disiplin') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            {{-- Skill dan Sertifikasi --}}
            <div class="form-group">
                <label for="sertifikasi">Sertifikasi (pisahkan dengan koma):</label>
                <input type="text" id="sertifikasi" name="sertifikasi" value="{{ old('sertifikasi') }}" placeholder="Contoh: PMP, AWS Certified">
                @error('sertifikasi') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="softSkill">Soft Skill (pisahkan dengan koma):</label>
                <input type="text" id="softSkill" name="softSkill" value="{{ old('softSkill') }}" placeholder="Contoh: Komunikasi, Kerja Tim">
                @error('softSkill') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="kepemimpinan">Memiliki Pengalaman Kepemimpinan?</label>
                <select id="kepemimpinan" name="kepemimpinan" required>
                    <option value="" {{ old('kepemimpinan') == '' ? 'selected' : '' }}>Pilih</option>
                    <option value="1" {{ old('kepemimpinan') == '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ old('kepemimpinan') == '0' ? 'selected' : '' }}>Tidak</option>
                </select>
                @error('kepemimpinan') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group-full">
                <button type="submit" class="submit-button">Dapatkan Rekomendasi</button>
            </div>
        </form>

        <div id="rekomendasiResult" class="rekomendasi-hasil" style="display: none;">
            <h3>Hasil Rekomendasi Jabatan:</h3>
            <p class="jabatan-hasil"></p>
            <p>Terima kasih telah menggunakan layanan kami!</p>
        </div>
        <div id="errorMessage" class="error-message-box" style="display: none;">
            <p></p>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('rekomendasiForm');
            const rekomendasiResultDiv = document.getElementById('rekomendasiResult');
            const jabatanHasilP = rekomendasiResultDiv.querySelector('.jabatan-hasil');
            const errorMessageDiv = document.getElementById('errorMessage');
            const errorMessageP = errorMessageDiv.querySelector('p');

            form.addEventListener('submit', async function(event) {
                event.preventDefault(); // Prevent default form submission

                // Hide previous results/errors
                rekomendasiResultDiv.style.display = 'none';
                errorMessageDiv.style.display = 'none';

                const formData = {
                    nama: document.getElementById('nama').value,
                    pendidikan: document.getElementById('pendidikan').value,
                    pengalaman: parseInt(document.getElementById('pengalaman').value),
                    lamaBekerja: parseInt(document.getElementById('lamaBekerja').value),
                    kinerja: parseInt(document.getElementById('kinerja').value),
                    disiplin: parseInt(document.getElementById('disiplin').value),
                    sertifikasi: document.getElementById('sertifikasi').value,
                    softSkill: document.getElementById('softSkill').value,
                    kepemimpinan: parseInt(document.getElementById('kepemimpinan').value) === 1 ? true : false
                };

                try {
                    const response = await fetch('http://localhost:8080/rekomendasi', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'x-api-key': '84019f550b6a25998452b485292df3320fc4f0b9c03b71256b07377a6a94a81f'
                        },
                        body: JSON.stringify(formData)
                    });

                    const data = await response.json();

                    if (response.ok) {
                        if (data.jabatan) {
                            jabatanHasilP.textContent = data.jabatan;
                            rekomendasiResultDiv.style.display = 'block';
                        } else {
                            errorMessageP.textContent = 'API response did not contain a recommendation.';
                            errorMessageDiv.style.display = 'block';
                        }
                    } else {
                        errorMessageP.textContent = data.message || 'Terjadi kesalahan saat mendapatkan rekomendasi.';
                        errorMessageDiv.style.display = 'block';
                    }
                } catch (error) {
                    console.error('Error:', error);
                    errorMessageP.textContent = 'Terjadi kesalahan jaringan atau server tidak merespons.';
                    errorMessageDiv.style.display = 'block';
                }
            });
        });
    </script>
    </section>
@endsection

{{-- Bagian @push('styles') DIHAPUS DARI SINI --}}