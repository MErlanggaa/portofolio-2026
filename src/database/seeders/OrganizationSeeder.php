<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizations = [
            [
                'name' => 'HIMAKOMP (Computer Science Student Association)',
                'role' => 'Vice Chairman',
                'start_date' => '2025-01-01',
                'end_date' => null,
                'is_current' => true,
                'description' => '<ul><li>Led organizational operations and coordinated cross-functional teams.</li><li>Assisted executive leadership in strategic decision-making.</li><li>Strengthened communication and collaboration between departments while ensuring successful execution of organizational programs.</li></ul>',
            ],
            [
                'name' => 'MNC University Scholarship Committee (MFLS)',
                'role' => 'Head of IT Department',
                'start_date' => '2025-01-01',
                'end_date' => null,
                'is_current' => true,
                'description' => '<ul><li>Led a team of three developers responsible for scholarship management systems.</li><li>Oversaw system development, maintenance, and technical operations during events.</li><li>Improved workflow efficiency through effective task delegation and project coordination.</li></ul>',
            ],
            [
                'name' => 'Student Council (OSIS)',
                'role' => 'Coordinator of Academic & Entrepreneurship Division',
                'start_date' => '2023-07-01',
                'end_date' => '2024-06-30',
                'is_current' => false,
                'description' => '<ul><li>Coordinated academic development and entrepreneurship programs.</li><li>Served as an organizing committee member for major school events, including MPLS and LDKO.</li><li>Assisted in planning and executing educational activities to ensure successful event delivery.</li></ul>',
            ],
            [
                'name' => 'Orens Solution (Extracurricular Organization)',
                'role' => 'Project Lead',
                'start_date' => '2023-07-01',
                'end_date' => '2024-06-30',
                'is_current' => false,
                'description' => '<ul><li>Led software development projects for competitions.</li><li>Coordinated development teams throughout project execution.</li><li>Contributed directly to application development while managing project timelines.</li><li>Supervised booth operations during school technology exhibitions.</li></ul>',
            ],
        ];

        foreach ($organizations as $org) {
            Organization::updateOrCreate(
                ['name' => $org['name'], 'role' => $org['role']],
                [
                    'start_date' => $org['start_date'],
                    'end_date' => $org['end_date'],
                    'is_current' => $org['is_current'],
                    'description' => $org['description'],
                ]
            );
        }
    }
}
