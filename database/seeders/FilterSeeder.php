<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filters')->insert([
            // Job Types
            ['type' => 'job_type', 'label' => 'Full-time', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'job_type', 'label' => 'Freelance', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'job_type', 'label' => 'Contract', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'job_type', 'label' => 'Part-time', 'created_at' => now(), 'updated_at' => now()],

            // Experience Levels
            ['type' => 'experience', 'label' => 'Entry Level', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'experience', 'label' => 'Mid Level', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'experience', 'label' => 'Senior Level', 'created_at' => now(), 'updated_at' => now()],

            // Salary Ranges
            ['type' => 'salary_range', 'label' => '$30k - $50k', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'salary_range', 'label' => '$50k - $80k', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'salary_range', 'label' => '$80k - $120k', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'salary_range', 'label' => '$120k+', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
