<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

final class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Заказная веб-разработка и усиление IT-команд',
                'description' => 'Мы работаем над онлайн-сервисами в области корпоративного и промышленного управления, автоматизации процессов (CRM, ERM, ERP), e-commerce и онлайн-образования',
                'order' => 1,
            ],
            [
                'title' => 'Разработка мобильных приложений',
                'description' => 'Создаем нативные и кроссплатформенные мобильные приложения для iOS и Android с современным дизайном и высокой производительностью',
                'order' => 2,
            ],
            [
                'title' => 'Консультации по цифровой трансформации',
                'description' => 'Помогаем бизнесу внедрять современные технологии, оптимизировать процессы и повышать эффективность работы команды',
                'order' => 3,
            ],
        ];

        foreach ($banners as $bannerData) {
            $banner = Banner::factory()->withMedia()->create([
                'title' => $bannerData['title'],
                'description' => $bannerData['description'],
                'order' => $bannerData['order'],
            ]);
        }
    }
}
