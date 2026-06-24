<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Position;
use Illuminate\Database\Seeder;

final class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $positions = Position::all();

        Author::factory(8)->create()->each(function (Author $author) use ($positions) {
            $randomPositionsCount = rand(1, 3);
            $randomPositions = $positions->random($randomPositionsCount);
            $author->positions()->attach($randomPositions->pluck('id'));
        });
    }
}
