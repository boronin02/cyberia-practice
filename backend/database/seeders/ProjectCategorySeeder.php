<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

final class ProjectCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Интернет-магазины', 'order' => 1],
            ['name' => 'CRM системы', 'order' => 2],
            ['name' => 'Корпоративные сайты', 'order' => 3],
            ['name' => 'Лендинги', 'order' => 4],
            ['name' => 'Веб-приложения', 'order' => 5],
            ['name' => 'Мобильные приложения', 'order' => 6],
        ];

        foreach ($categories as $category) {
            ProjectCategory::create($category);
        }
    }
}
