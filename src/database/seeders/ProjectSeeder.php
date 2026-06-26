<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate and recreate cleanly
        Project::truncate();

        $projects = [
            // ── BEASISWAMNCU ECOSYSTEM ──────────────────────────────
            [
                'title'       => 'Beasiswamncu.com',
                'description' => 'Full-stack scholarship management platform with integrated admin dashboard, reporting, and REST API backend powered by Laravel 11.',
                'tech_stack'  => 'Laravel, PHP, Tailwind CSS, MySQL',
                'api_stack'   => 'REST API (Laravel 11)',
                'image'       => null,
                'link'        => 'https://beasiswamncu.com',
            ],
            [
                'title'       => 'Ujian Beasiswamncu',
                'description' => 'Front-end online examination platform with a modern, responsive interface consuming the Beasiswamncu REST API.',
                'tech_stack'  => 'React.js, Vite, Tailwind CSS',
                'api_stack'   => null,
                'image'       => null,
                'link'        => 'https://ujian.beasiswamncu.com',
            ],
            [
                'title'       => 'Jyaa Beasiswamncu',
                'description' => 'Full-stack web application for scholarship form submissions and candidate management, built with Laravel.',
                'tech_stack'  => 'Laravel, PHP, Tailwind CSS',
                'api_stack'   => null,
                'image'       => null,
                'link'        => 'https://jyaa.beasiswamncu.com',
            ],
            [
                'title'       => 'Management Beasiswamncu',
                'description' => 'Administrative management system for internal scholarship operations and data monitoring.',
                'tech_stack'  => 'Laravel, Tailwind CSS, Leaflet',
                'api_stack'   => null,
                'image'       => null,
                'link'        => null,
            ],

            // ── PRODUCTBAIK ─────────────────────────────────────────
            [
                'title'       => 'ProductBaik',
                'description' => 'Full-stack product management platform with CRUD operations, authentication, and a dedicated RESTful API layer built in Laravel 10.',
                'tech_stack'  => 'Laravel, Tailwind CSS, MySQL',
                'api_stack'   => 'RESTful API (Laravel 10)',
                'image'       => null,
                'link'        => null,
            ],

            // ── OTHER PROJECTS ──────────────────────────────────────
            [
                'title'       => 'UMKM.go',
                'description' => 'MSME information platform featuring an interactive map powered by Leaflet for geolocation-based discovery.',
                'tech_stack'  => 'Laravel, Tailwind CSS, Leaflet',
                'api_stack'   => null,
                'image'       => null,
                'link'        => null,
            ],
            [
                'title'       => 'Greenovation',
                'description' => 'Environmental awareness website with interactive location features and educational content about sustainability.',
                'tech_stack'  => 'Laravel, Tailwind CSS, Leaflet',
                'api_stack'   => null,
                'image'       => null,
                'link'        => null,
            ],
            [
                'title'       => 'AntiKetiduran',
                'description' => 'Web application that consumes a public REST API to detect and alert drowsiness patterns using sensor data.',
                'tech_stack'  => 'Laravel, Tailwind CSS',
                'api_stack'   => 'Public REST API',
                'image'       => null,
                'link'        => null,
            ],
            [
                'title'       => 'Event Management System',
                'description' => 'Event management and ticketing platform for organizing, registering, and managing campus events.',
                'tech_stack'  => 'Laravel, Tailwind CSS',
                'api_stack'   => null,
                'image'       => null,
                'link'        => null,
            ],
            [
                'title'       => 'Wings',
                'description' => 'Responsive front-end development for an enterprise project, focusing on UI/UX design consistency.',
                'tech_stack'  => 'Laravel, Tailwind CSS',
                'api_stack'   => null,
                'image'       => null,
                'link'        => null,
            ],
            [
                'title'       => 'BahteraLembah System',
                'description' => 'Company profile website built with WordPress and Elementor with custom post types and SEO optimization.',
                'tech_stack'  => 'WordPress, Elementor',
                'api_stack'   => null,
                'image'       => null,
                'link'        => null,
            ],
            [
                'title'       => 'Berkah System',
                'description' => 'Business website with custom WordPress implementation, tailored for local business needs.',
                'tech_stack'  => 'WordPress, Elementor',
                'api_stack'   => null,
                'image'       => null,
                'link'        => null,
            ],
            [
                'title'       => 'Perpustakaan Digital',
                'description' => 'Digital library website for browsing and managing library collections online.',
                'tech_stack'  => 'WordPress, Elementor',
                'api_stack'   => null,
                'image'       => null,
                'link'        => null,
            ],
            [
                'title'       => 'AbsensiPKL',
                'description' => 'Internship attendance system with GPS-based location tracking using Leaflet maps.',
                'tech_stack'  => 'Laravel, Tailwind CSS, Leaflet',
                'api_stack'   => null,
                'image'       => null,
                'link'        => null,
            ],
            [
                'title'       => '2D Game',
                'description' => 'Developed a 2D platformer game as part of academic coursework and game development practice using Unity engine.',
                'tech_stack'  => 'Unity, C#',
                'api_stack'   => null,
                'image'       => null,
                'link'        => null,
            ],
        ];

        foreach ($projects as $proj) {
            Project::create($proj);
        }
    }
}
