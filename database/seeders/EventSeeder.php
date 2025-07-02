<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'title' => '3D Animation Fundamentals',
                'type' => 'Workshop',
                'start' => Carbon::parse('2025-01-20 09:00:00'),
                'end' => Carbon::parse('2025-01-20 17:00:00'),
                'user_id' => 1,
                'description' => 'Learn the basics of 3D animation using industry-standard software. Perfect for beginners looking to enter the field of digital animation.',
                'start_time' => '9:00',
                'start_ampm' => 'AM',
                'duration' => 8,
                'location' => 'Creative Studio, NYC',
                'reminder' => '1 day before',
                'image_path' => 'workshop1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Video Editing Masterclass',
                'type' => 'Convention',
                'start' => Carbon::parse('2025-01-25 10:00:00'),
                'end' => Carbon::parse('2025-01-25 18:00:00'),
                'user_id' => 1,
                'description' => 'Advanced techniques in video editing, color grading, and post-production workflows for professional results.',
                'start_time' => '10:00',
                'start_ampm' => 'AM',
                'duration' => 8,
                'location' => 'Media Lab, LA',
                'reminder' => '1 day before',
                'image_path' => 'workshop2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Digital Arts Summit',
                'type' => 'Exhibition',
                'start' => Carbon::parse('2025-03-15 09:00:00'),
                'end' => Carbon::parse('2025-03-17 17:00:00'),
                'user_id' => 1,
                'description' => 'The premier gathering for digital artists, featuring keynotes, exhibitions, and networking with industry professionals.',
                'start_time' => '9:00',
                'start_ampm' => 'AM',
                'duration' => 24, // over 3 days
                'location' => 'Convention Center, San Francisco',
                'reminder' => '2 days before',
                'image_path' => 'summit.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Audio Production & Sound Design',
                'type' => 'Workshop',
                'start' => Carbon::parse('2025-02-02 10:00:00'),
                'end' => Carbon::parse('2025-02-02 17:00:00'),
                'user_id' => 1,
                'description' => 'Explore the world of audio production, from recording techniques to advanced sound design for multimedia projects.',
                'start_time' => '10:00',
                'start_ampm' => 'AM',
                'duration' => 7,
                'location' => 'Sound Studio, Nashville',
                'reminder' => '1 day before',
                'image_path' => 'audio.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Interactive Media Expo',
                'type' => 'Convention',
                'start' => Carbon::parse('2025-04-08 09:00:00'),
                'end' => Carbon::parse('2025-04-10 18:00:00'),
                'user_id' => 1,
                'description' => 'Showcase of the latest in interactive media, VR/AR technologies, and immersive experiences.',
                'start_time' => '9:00',
                'start_ampm' => 'AM',
                'duration' => 27,
                'location' => 'Tech Center, Austin',
                'reminder' => '2 days before',
                'image_path' => 'expo.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Digital Art Gallery Opening',
                'type' => 'Exhibition',
                'start' => Carbon::parse('2025-02-15 11:00:00'),
                'end' => Carbon::parse('2025-02-28 18:00:00'),
                'user_id' => 1,
                'description' => 'Grand opening of a new digital art gallery featuring works from emerging and established multimedia artists.',
                'start_time' => '11:00',
                'start_ampm' => 'AM',
                'duration' => 104, // 2 weeks (estimate)
                'location' => 'Art District, Miami',
                'reminder' => '3 days before',
                'image_path' => 'gallery.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
