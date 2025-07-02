<?php

namespace Database\Seeders;

use App\Models\PartnerIndustry;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partners = [
            [
                'name' => 'Tech Innovators Inc.',
                'type' => 'industry',
                'description' => 'Leading technology firm driving innovation in multimedia solutions.',
                'logo_url' => 'https://via.placeholder.com/120x120/e09900/ffffff?text=TI',
            ],
            [
                'name' => 'State University',
                'type' => 'academe',
                'description' => 'Academic institution offering top-tier multimedia arts programs.',
                'logo_url' => 'https://via.placeholder.com/120x120/1e40af/ffffff?text=SU',
            ],
            [
                'name' => 'Creative Gears',
                'type' => 'vendor',
                'description' => 'Supplier of multimedia tools and equipment for creatives.',
                'logo_url' => 'https://via.placeholder.com/120x120/f59e0b/ffffff?text=CG',
            ],
            [
                'name' => 'Media Pros Network',
                'type' => 'affiliate',
                'description' => 'Group of professional multimedia artists and freelancers.',
                'logo_url' => 'https://via.placeholder.com/120x120/7c3aed/ffffff?text=MPN',
            ],
            [
                'name' => 'Global Arts Alliance',
                'type' => 'partners',
                'description' => 'International partner supporting cross-border creative initiatives.',
                'logo_url' => 'https://via.placeholder.com/120x120/059669/ffffff?text=GAA',
            ],
        ];

        foreach ($partners as $partner) {
            PartnerIndustry::create($partner);
        }
    }
}
