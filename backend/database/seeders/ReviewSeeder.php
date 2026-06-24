<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Review;
use Illuminate\Database\Seeder;

final class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();

        for ($i = 0; $i < 6; $i++) {
            Review::factory()
                ->withMedia()
                ->state(['project_id' => $projects->random()->id])
                ->create();
        }
    }
}
