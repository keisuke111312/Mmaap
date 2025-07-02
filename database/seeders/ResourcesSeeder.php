<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resources')->insert([
            // Agencies
            [
                'user_id' => 1,
                'title' => 'Creative Campaigns: Best Practices from Leading Agencies',
                'category' => 'Article',
                'author' => 'Pixel Agency',
                'tags' => 'branding, strategy, campaigns',
                'description' => 'Explore case studies and creative strategies used by top multimedia agencies to deliver impactful campaigns.',
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Visual Identity Guidelines: From Concept to Launch',
                'category' => 'Article',
                'author' => 'Nova Creatives',
                'tags' => 'identity, design system, style guide',
                'description' => 'A breakdown of how agencies develop and manage cohesive visual identity systems for clients.',
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Schools
            [
                'user_id' => 1,
                'title' => 'Teaching Motion Graphics in Modern Classrooms',
                'category' => 'Article',
                'author' => 'Prof. Ana Reyes',
                'tags' => 'motion, education, animation',
                'description' => 'A resource pack for multimedia arts educators teaching motion design and animation to students.',
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Curriculum Design for Interactive Media Arts',
                'category' => 'Article',
                'author' => 'Digital Arts Institute',
                'tags' => 'curriculum, interactive, media arts',
                'description' => 'A guide for academic institutions building interactive media programs within multimedia arts departments.',
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Professionals
            [
                'user_id' => 1,
                'title' => 'Building a Freelance Brand as a Multimedia Artist',
                'category' => 'Tutorial',
                'author' => 'Liam Castillo',
                'tags' => 'freelance, personal branding, portfolio',
                'description' => 'Learn how to develop your personal brand and portfolio to succeed as a freelance multimedia artist.',
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Tools & Techniques for Efficient Content Production',
                'category' => 'Research',
                'author' => 'Janelle Yao',
                'tags' => 'tools, workflow, production',
                'description' => 'An overview of essential tools and techniques for multimedia professionals looking to streamline production workflows.',
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
