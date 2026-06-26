<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::updateOrCreate(
            ['name' => 'Muhammad Erlangga Putra Witanto'],
            [
                'title' => 'Full-Stack Web Developer',
                'description' => '<p>A results-driven Computer Science student with hands-on experience in full-stack web development, specializing in Laravel, Tailwind CSS, RESTful API integration, and WordPress development. Proven leadership experience as Vice Chairman of HIMAKOMP and Head of the IT Department for the MNC University Scholarship Committee. Passionate about building scalable web applications, leading technical teams, and delivering innovative digital solutions through strong problem-solving and collaboration skills.</p>',
                'email' => 'erlanggaputrawitanto@gmail.com',
                'phone' => null,
                'github' => 'https://github.com',
                'linkedin' => 'https://linkedin.com',
                'instagram' => 'https://instagram.com',
                'photo' => null,
            ]
        );
    }
}
