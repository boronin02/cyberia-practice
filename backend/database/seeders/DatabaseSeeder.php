<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->admin()
            ->create();

        $this->call([
            ProjectCategorySeeder::class,
            PositionSeeder::class,
            AuthorSeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            VacancySeeder::class,
            BannerSeeder::class,
            ProjectSeeder::class,
            ReviewSeeder::class,
            AwardSeeder::class,
            ContactSeeder::class,
        ]);
    }
}
