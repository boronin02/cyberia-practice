<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

final class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Docker'],
            ['name' => 'Laravel'],
            ['name' => 'Filament'],
            ['name' => 'Code Style'],
            ['name' => 'Gitlab'],
            ['name' => 'DevOps'],
            ['name' => 'CI/CD'],
            ['name' => 'VPS/VDS'],
            ['name' => 'ИИ'],
            ['name' => 'Нейросети'],
            ['name' => 'Автоматизация'],
            ['name' => 'Инфраструктура'],
            ['name' => 'Лучшие практики'],
            ['name' => 'Техподдержка'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
