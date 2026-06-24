<?php

namespace Database\Factories;

use App\Enums\Media\MediaCollectionType;
use App\Models\Review;
use Database\Factories\Concerns\HasImagesFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;

/**
 * @extends Factory<Review>
 */
final class ReviewFactory extends Factory
{
    use HasImagesFactory;

    protected $model = Review::class;

    public function definition(): array
    {
        $reviewTemplates = [
            'Отличная работа команды разработчиков! Проект выполнен качественно и в срок. Особенно порадовал профессиональный подход к решению технических задач.',
            'Благодарим за профессиональную разработку. Команда показала высокий уровень экспертизы и внимательность к деталям на каждом этапе проекта.',
            'Результат превзошел наши ожидания. Разработчики создали удобный и функциональный продукт, который полностью соответствует нашим требованиям.',
            'Надежная команда, которая организованно ведет проект и соблюдает сроки. Глубоко вникают в продукт и предлагают обоснованные решения.',
            'Спасибо за качественную разработку! Команда гибко реагировала на изменения, общалась четко и профессионально.',
            'Отличный результат работы. Разработчики создали стабильную архитектуру и понятный интерфейс. Ценим оперативность на всех этапах.',
        ];

        return [
            'fio' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'position' => $this->faker->randomElement([
                'Генеральный директор',
                'Руководитель проекта',
                'Технический директор',
                'Менеджер по развитию',
                'Основатель',
                'CTO',
                'Директор по развитию',
            ]),
            'content' => $this->faker->randomElement($reviewTemplates),
            'order' => $this->faker->numberBetween(1, 10),
            'project_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function withMedia(): self
    {
        return $this->afterCreating(function (HasMedia $model) {
            if ($this->faker->boolean(70)) {
                $this->attachImage($model, MediaCollectionType::ReviewImage);
            }
            if ($this->faker->boolean(30)) {
                $this->attachImage($model, MediaCollectionType::ReviewDocument);
            }
        });
    }
}
