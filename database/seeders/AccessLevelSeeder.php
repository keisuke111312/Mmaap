<?php

namespace Database\Seeders;

use App\Models\AccessLevel;
use Illuminate\Database\Seeder;

class AccessLevelSeeder extends Seeder
{

    public function run()
    {
        $levels = [
            ['name' => 'Free', 'description' => 'Basic free access level'],
            ['name' => 'Member', 'description' => 'Registered member with additional privileges'],
            ['name' => 'Premium', 'description' => 'Full access including premium features'],
        ];

        foreach ($levels as $level) {
            AccessLevel::firstOrCreate(['name' => $level['name']], $level);
        }
    }
}
