<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educations = [
            [
                'institution' => 'MNC University',
                'degree' => 'Bachelor of Computer Science',
                'major' => 'Computer Science',
                'start_date' => '2025-09-01',
                'end_date' => null,
                'is_current' => true,
                'description' => 'Currently pursuing a Bachelor\'s degree in Computer Science with a focus on Software Engineering, Web Development, and Information Systems. Actively participating in student organizations and technical projects to strengthen both leadership and software development expertise.',
            ],
            [
                'institution' => 'SMK Prestasi Prima',
                'degree' => 'SMK',
                'major' => 'Software & Game Development (PPLG)',
                'start_date' => '2022-07-01',
                'end_date' => '2025-06-30',
                'is_current' => false,
                'description' => 'Completed vocational education specializing in Software and Game Development, with coursework covering software engineering, system design, project management, and full-stack web development using PHP, HTML, CSS, JavaScript, and MySQL.',
            ],
        ];

        foreach ($educations as $edu) {
            Education::updateOrCreate(
                ['institution' => $edu['institution'], 'degree' => $edu['degree']],
                [
                    'major' => $edu['major'],
                    'start_date' => $edu['start_date'],
                    'end_date' => $edu['end_date'],
                    'is_current' => $edu['is_current'],
                    'description' => $edu['description'],
                ]
            );
        }
    }
}
