<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan halaman beranda dengan rekomendasi jabatan (dummy data).
     */
    public function home()
    {
        // Dummy data untuk tampilan awal
        $jobs = [
            [
                'id' => 'J001',
                'title' => 'Software Engineer (Frontend)',
                'description' => 'Membangun antarmuka pengguna web yang responsif dan interaktif menggunakan teknologi modern.',
                'skills_required' => ['JavaScript', 'React.js', 'HTML', 'CSS', 'UI/UX']
            ],
            [
                'id' => 'J002',
                'title' => 'Backend Developer (Node.js)',
                'description' => 'Merancang dan mengimplementasikan logika server-side, database, dan API.',
                'skills_required' => ['Node.js', 'Express.js', 'MongoDB', 'RESTful API', 'SQL']
            ],
            [
                'id' => 'J003',
                'title' => 'Data Scientist',
                'description' => 'Menganalisis data besar untuk menemukan wawasan dan membangun model prediktif.',
                'skills_required' => ['Python', 'R', 'Machine Learning', 'Statistika', 'SQL', 'Big Data']
            ],
            [
                'id' => 'J004',
                'title' => 'Project Manager (IT)',
                'description' => 'Memimpin tim proyek IT, memastikan pencapaian tujuan dan tenggat waktu.',
                'skills_required' => ['Manajemen Proyek', 'Agile', 'Scrum', 'Komunikasi', 'Leadership']
            ],
        ];

        return view('home', compact('jobs'));
    }

    /**
     * Menampilkan halaman dokumentasi API.
     */
    public function apiDocs()
    {
        return view('api-docs');
    }
}