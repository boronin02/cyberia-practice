<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

final class PostSeeder extends Seeder
{
    public function run(): void
    {
        $authors = Author::all();
        $tags = Tag::all();

        $posts = [
            [
                'title' => 'Мы на чемпионате «Профессионалы»!',
                'description' => '<p>«Профессионалы» — Всероссийский чемпионат по профмастерству среди студентов СПО, проводится с 13 по 20 февраля при поддержке Министерства просвещения РФ</p>',
                'is_news' => true,
                'is_popular' => true,
                'is_published' => true,
                'published_at' => '2026-01-16 15:00:00',
            ],
            [
                'title' => 'Наш проект стал призёром Tagline Awards 2025',
                'description' => '<p>Наш проект Omega-CRM получил призовое место на премии Tagline Awards 2025. Для команды это дебютное участие в одной из ключевых профессиональных наград digital-индустрии — и сразу результат</p>',
                'is_news' => true,
                'is_popular' => false,
                'is_published' => true,
                'published_at' => '2026-01-14 15:00:00',
            ],
            [
                'title' => 'Как развернуть сайт на VDS',
                'description' => '<p>Рассказываем основы выбора и настройки сервера для публикации веб-проекта в сети</p>',
                'is_news' => false,
                'is_popular' => false,
                'is_published' => true,
                'published_at' => '2024-05-17 19:24:15',
            ],
            [
                'title' => 'Обзор хостингов-2024: наш опыт работы с крупными современными провайдерами',
                'description' => '<p>Честный обзор популярных хостингов — с плюсами, минусами и реальными выводами из практики</p>',
                'is_news' => false,
                'is_popular' => false,
                'is_published' => true,
                'published_at' => '2024-02-24 18:31:09',
            ],
            [
                'title' => '5 признаков того, что вашему бизнесу нужны нейросети',
                'description' => '<p>Разобрали пять ключевых показателей, по которым можно понять, готов ли бизнес к внедрению нейросетей и какие преимущества это может дать</p>',
                'is_news' => false,
                'is_popular' => true,
                'is_published' => true,
                'published_at' => '2025-07-23 18:07:10',
            ],
            [
                'title' => 'Внедряем CI/CD в разработку с помощью Gitlab CI',
                'description' => '<p>Она позволяет разработчикам сосредоточиться на решении задач, не тратя время на рутинные действия, связанные с деплоем нового функционала или правок</p>',
                'is_news' => false,
                'is_popular' => false,
                'is_published' => true,
                'published_at' => '2024-07-25 14:46:19',
            ],
        ];

        foreach ($posts as $postData) {
            $post = Post::factory()->create([
                'title' => $postData['title'],
                'description' => $postData['description'],
                'is_news' => $postData['is_news'],
                'is_popular' => $postData['is_popular'],
                'is_published' => $postData['is_published'],
                'published_at' => $postData['published_at'],
                'content' => [
                    [
                        'type' => 'paragraph',
                        'data' => [
                            'content' => '<p>' . fake()->paragraphs(3, true) . '</p>',
                        ],
                    ],
                ],
            ]);

            $randomAuthorsCount = rand(1, 2);
            $randomAuthors = $authors->random($randomAuthorsCount);
            $post->authors()->attach($randomAuthors->pluck('id'));

            $randomTagsCount = rand(2, 4);
            $randomTags = $tags->random($randomTagsCount);
            $post->tags()->attach($randomTags->pluck('id'));
        }
    }
}
