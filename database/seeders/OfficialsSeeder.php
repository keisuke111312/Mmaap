<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
 public function run(): void
    {
        // Get or create the term (2025–2027)
        $termId = DB::table('official_terms')->insertGetId([
            'year_start' => '2025',
            'year_end' => '2027',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Map of position titles to their official_position IDs
        $positions = DB::table('official_positions')->pluck('id', 'title');

        $officials = [
            ['name' => 'Mr. Ronnie Luy', 'position' => 'President', 'affiliation' => 'Gordon College'],
            ['name' => 'Dr. Richmon Carabeo', 'position' => 'Vice President for Internal Affairs', 'affiliation' => 'Bataan Peninsula State University'],
            ['name' => 'Ms. Jasmiene Domingo', 'position' => 'Vice President for External Affairs', 'affiliation' => 'Baliuag University'],
            ['name' => 'Mr. Gorge C. Granados', 'position' => 'Vice President for Education', 'affiliation' => 'Systems Plus College Foundation'],
            ['name' => 'Mrs. Analizel Del Poso', 'position' => 'Secretary', 'affiliation' => 'Baliuag University'],
            ['name' => 'Dr. Jennifer Solis', 'position' => 'Treasurer', 'affiliation' => 'Bulacan State University'],
            ['name' => 'Dr. Fernand T. Layug', 'position' => 'Auditor', 'affiliation' => 'Sta Rita College'],
        ];

        foreach ($officials as $official) {
            DB::table('officials')->insert([
                'name' => $official['name'],
                'title_abbreviation' => null,
                'position_id' => $positions[$official['position']],
                'term_id' => $termId,
                'photo_url' => null,
                'bio' => $official['affiliation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
