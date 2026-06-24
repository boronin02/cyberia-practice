<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

final class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ProjectCategory::all();

        for ($i = 0; $i < 20; $i++) {
            Project::factory()
                ->withMedia()
                ->state(['project_category_id' => $categories->random()->id])
                ->create();
        }
    }
}
