@extends('layouts.app')

@section('title', 'Beranda - Rekomendasi Jabatan')

@section('content')
    <section class="hero-section">
        <h2>Temukan Peluang Karir Impian Anda</h2>
        <p>Jelajahi rekomendasi jabatan yang sesuai dengan keterampilan dan minat Anda. Platform API gratis untuk para pengembang.</p>
    </section>

    <section class="job-recommendations-section">
        <h3>Rekomendasi Jabatan Terkini</h3>
        <div class="job-list">
            @forelse ($jobs as $job)
                <div class="job-card">
                    <h4 class="job-title">{{ $job['title'] }}</h4>
                    <p class="job-description">{{ $job['description'] }}</p>
                    @if (isset($job['skills_required']) && is_array($job['skills_required']))
                        <div class="job-skills">
                            @foreach ($job['skills_required'] as $skill)
                                <span class="skill-tag">{{ $skill }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <p>Tidak ada rekomendasi jabatan yang tersedia saat ini.</p>
            @endforelse
        </div>
    </section>
@endsection