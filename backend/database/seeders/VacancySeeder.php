<?php

namespace Database\Seeders;

use App\Models\Vacancy;
use Illuminate\Database\Seeder;

final class VacancySeeder extends Seeder
{
    public function run(): void
    {
        $vacancies = [
            [
                'name_first' => 'UX/UI',
                'name_second' => 'веб-',
                'name_third' => 'дизайнер',
                'terms' => [
                    ['text' => 'Опыт работы: 1–3 года'],
                    ['text' => 'ЗП: 90 000–120 000₽'],
                    ['text' => 'UX/UI, Figma'],
                ],
                'link' => 'https://barnaul.hh.ru/vacancy/117951695',
                'show_on_home' => false,
                'order' => 1,
            ],
            [
                'name_first' => 'Frontend',
                'name_second' => '-разработчик',
                'name_third' => null,
                'terms' => [
                    ['text' => 'Опыт работы: 2–4 года'],
                    ['text' => 'ЗП: 120 000–180 000 ₽'],
                    ['text' => 'React, TypeScript, Next.js'],
                ],
                'link' => 'https://barnaul.hh.ru/vacancy/119541298',
                'show_on_home' => true,
                'order' => 2,
            ],
            [
                'name_first' => 'Backend',
                'name_second' => '-разработчик',
                'name_third' => null,
                'terms' => [
                    ['text' => 'Опыт работы: 3–5 лет'],
                    ['text' => 'ЗП: 150 000–220 000 ₽'],
                    ['text' => 'PHP, Laravel, PostgreSQL'],
                ],
                'link' => 'https://barnaul.hh.ru/vacancy/119898965',
                'show_on_home' => true,
                'order' => 3,
            ],
            [
                'name_first' => 'Project',
                'name_second' => '-менеджер',
                'name_third' => null,
                'terms' => [
                    ['text' => 'Опыт работы: 1–2 года'],
                    ['text' => 'ЗП: 90 000–120 000 ₽'],
                    ['text' => 'Управление командой, планирование, тайм-менеджмент'],
                ],
                'link' => 'https://barnaul.hh.ru/vacancy/120001234',
                'show_on_home' => false,
                'order' => 4,
            ],
        ];

        foreach ($vacancies as $vacancy) {
            Vacancy::create($vacancy);
        }
    }
}
