<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\Project;
use Illuminate\Database\Seeder;

final class AwardSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();

        for ($i = 0; $i < 4; $i++) {
            Award::factory()
                ->withMedia()
                ->state(['project_id' => $projects->random()->id])
                ->create();
        }
    }
}
