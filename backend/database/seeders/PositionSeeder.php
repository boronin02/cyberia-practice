<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

final class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            ['name' => 'CEO'],
            ['name' => 'Разработчик'],
            ['name' => 'Дизайнер'],
            ['name' => 'Менеджер проектов'],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}
