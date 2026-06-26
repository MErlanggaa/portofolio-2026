<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            // Programming Languages
            ['name' => 'PHP', 'category' => 'Programming Languages', 'proficiency' => 90],
            ['name' => 'JavaScript', 'category' => 'Programming Languages', 'proficiency' => 85],
            ['name' => 'TypeScript', 'category' => 'Programming Languages', 'proficiency' => 80],
            ['name' => 'HTML5', 'category' => 'Programming Languages', 'proficiency' => 95],
            ['name' => 'CSS3', 'category' => 'Programming Languages', 'proficiency' => 90],

            // Frameworks & Libraries
            ['name' => 'Laravel', 'category' => 'Frameworks & Libraries', 'proficiency' => 90],
            ['name' => 'React.js', 'category' => 'Frameworks & Libraries', 'proficiency' => 80],
            ['name' => 'Tailwind CSS', 'category' => 'Frameworks & Libraries', 'proficiency' => 90],
            ['name' => 'WordPress', 'category' => 'Frameworks & Libraries', 'proficiency' => 85],
            ['name' => 'Elementor', 'category' => 'Frameworks & Libraries', 'proficiency' => 85],
            ['name' => 'Leaflet', 'category' => 'Frameworks & Libraries', 'proficiency' => 75],

            // Database
            ['name' => 'MySQL', 'category' => 'Database', 'proficiency' => 85],
            ['name' => 'MongoDB', 'category' => 'Database', 'proficiency' => 70],

            // API & Development Tools
            ['name' => 'RESTful API Development', 'category' => 'API & Development Tools', 'proficiency' => 85],
            ['name' => 'Postman', 'category' => 'API & Development Tools', 'proficiency' => 80],
            ['name' => 'Swagger (Basic)', 'category' => 'API & Development Tools', 'proficiency' => 60],

            // DevOps & Deployment
            ['name' => 'Docker (Basic)', 'category' => 'DevOps & Deployment', 'proficiency' => 65],
            ['name' => 'Railway', 'category' => 'DevOps & Deployment', 'proficiency' => 75],
            ['name' => 'cPanel', 'category' => 'DevOps & Deployment', 'proficiency' => 80],
            ['name' => 'Hostinger (hPanel)', 'category' => 'DevOps & Deployment', 'proficiency' => 80],
            ['name' => 'Domain & Hosting Management', 'category' => 'DevOps & Deployment', 'proficiency' => 80],

            // Version Control & Design
            ['name' => 'Git', 'category' => 'Version Control & Design', 'proficiency' => 85],
            ['name' => 'GitHub', 'category' => 'Version Control & Design', 'proficiency' => 85],
            ['name' => 'Figma', 'category' => 'Version Control & Design', 'proficiency' => 75],

            // Technical Support
            ['name' => 'Windows Installation', 'category' => 'Technical Support', 'proficiency' => 90],
            ['name' => 'Laptop & Smartphone Troubleshooting', 'category' => 'Technical Support', 'proficiency' => 85],
            ['name' => 'Hardware Upgrades (RAM & Storage)', 'category' => 'Technical Support', 'proficiency' => 90],

            // Soft Skills
            ['name' => 'Leadership', 'category' => 'Soft Skills', 'proficiency' => 90],
            ['name' => 'Team Collaboration', 'category' => 'Soft Skills', 'proficiency' => 90],
            ['name' => 'Communication', 'category' => 'Soft Skills', 'proficiency' => 85],
            ['name' => 'Problem Solving', 'category' => 'Soft Skills', 'proficiency' => 90],
            ['name' => 'Time Management', 'category' => 'Soft Skills', 'proficiency' => 80],
            ['name' => 'Adaptability', 'category' => 'Soft Skills', 'proficiency' => 85],
            ['name' => 'Responsibility & Accountability', 'category' => 'Soft Skills', 'proficiency' => 90],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name'], 'category' => $skill['category']],
                ['proficiency' => $skill['proficiency']]
            );
        }
    }
}
