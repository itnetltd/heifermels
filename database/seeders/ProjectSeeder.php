<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'code' => 'RDDP-II',
                'name' => 'Rwanda Dairy Development Project Phase II',
                'description' => 'Supports 75,000 new smallholder dairy farmers across 27 districts.',
                'target_households' => 75000,
            ],
            [
                'code' => 'PRISM',
                'name' => 'Partnership for Resilient and Inclusive Small Livestock Markets',
                'description' => 'Supports 24,300 small livestock farmers (chicken, piggery, goat, sheep) in 15 districts.',
                'target_households' => 24300,
            ],
            [
                'code' => 'PSAC',
                'name' => 'Promoting Smallholder Agro-export Competitiveness Project',
                'description' => 'Supports 2,000 smallholder horticulture farmers in 13 districts (tomato, garlic, onion, carrots, French beans, chili).',
                'target_households' => 2000,
            ],
            [
                'code' => 'RDMS',
                'name' => 'Rwanda Dairy Market System',
                'description' => 'Supports 10,500 dairy farmers in 4 districts to increase productivity.',
                'target_households' => 10500,
            ],
        ];

        foreach ($projects as $data) {
            Project::firstOrCreate(['code' => $data['code']], $data);
        }
    }
}
