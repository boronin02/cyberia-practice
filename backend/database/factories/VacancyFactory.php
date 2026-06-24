<?php

namespace Database\Factories;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Vacancy>
 */
final class VacancyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name_first' => $this->faker->jobTitle(),
            'name_second' => $this->faker->randomElement(['-разработчик', '-дизайнер', '-менеджер', ' специалист']),
            'name_third' => $this->faker->optional(0.3)->randomElement(['junior', 'middle', 'senior']),
            'link' => $this->faker->url(),
            'show_on_home' => $this->faker->boolean(30),
            'terms' => $this->generateTerms(),
            'order' => $this->faker->numberBetween(1, 10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    private function generateTerms(): array
    {
        return [
            ['text' => 'Опыт работы: ' . $this->faker->randomElement(['1–2 года', '2–3 года', '3–5 лет', 'от 1 года'])],
            ['text' => 'ЗП: ' . $this->faker->numberBetween(80, 200) . ' 000–' . $this->faker->numberBetween(120, 300) . ' 000 ₽'],
            ['text' => $this->faker->randomElement([
                'Знание PHP, Laravel',
                'React, TypeScript',
                'UX/UI, Figma',
                'Управление командой',
                'Опыт продаж',
                'Тестирование ПО',
                'DevOps, Docker',
            ])],
        ];
    }
}
