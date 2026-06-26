<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experiences = [
            [
                'company' => 'PT. INDI Technology',
                'role' => 'Full-Stack Web Developer Intern',
                'start_date' => '2024-08-01',
                'end_date' => '2024-12-31',
                'is_current' => false,
                'description' => '<ul><li>Awarded <strong>Best Vocational Intern</strong> in the Full-Stack Division.</li><li>Contributed to three enterprise projects: <strong>Wings</strong>, <strong>ProductBaik</strong>, and <strong>Event Management Ticketing System</strong>.</li><li>Developed responsive front-end interfaces using Tailwind CSS and TypeScript.</li><li>Built scalable backend systems with Laravel.</li><li>Improved code quality through code reviews and reusable coding practices.</li><li>Implemented interactive GIS features using Leaflet to enhance user experience.</li></ul>',
            ],
            [
                'company' => 'Freelance Web Developer',
                'role' => 'Freelance Web Developer',
                'start_date' => '2024-01-01',
                'end_date' => null,
                'is_current' => true,
                'description' => '<ul><li>Designed and developed custom WordPress websites based on client requirements.</li><li>Optimized website performance, responsiveness, and SEO readiness.</li><li>Managed website deployment, hosting configuration, and ongoing maintenance.</li></ul>',
            ],
            [
                'company' => 'Freelance Computer & Mobile Technician',
                'role' => 'Freelance Computer & Mobile Technician',
                'start_date' => '2023-01-01',
                'end_date' => null,
                'is_current' => true,
                'description' => '<ul><li>Diagnosed and resolved hardware and software issues for computers and mobile devices.</li><li>Installed operating systems and application software.</li><li>Performed RAM and storage upgrades.</li><li>Delivered reliable technical support and maintenance services.</li></ul>',
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::updateOrCreate(
                ['company' => $exp['company'], 'role' => $exp['role']],
                [
                    'start_date' => $exp['start_date'],
                    'end_date' => $exp['end_date'],
                    'is_current' => $exp['is_current'],
                    'description' => $exp['description'],
                ]
            );
        }
    }
}
