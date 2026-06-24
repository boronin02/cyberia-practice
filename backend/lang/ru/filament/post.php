<?php

return [
    'fields' => [
        'title' => 'Заголовок',
        'description' => 'Описание',
        'slug' => 'Ссылка',
        'image' => 'Изображение',
        'image_preview' => 'Превью изображения',
        'is_published' => 'Опубликован',
        'is_news' => 'Новость',
        'is_popular' => 'Популярное',
        'published_at' => 'Опубликован',
        'deleted_at' => 'Удален',
        'created_at' => 'Создан',
        'updated_at' => 'Обновлен',
        'authors' => 'Авторы',
        'tags' => 'Теги',
    ],
    'sections' => [
        'information' => 'Общая информация',
        'images' => 'Изображения',
        'marks' => 'Метки',
        'content' => 'Контент',
    ],
    'label' => [
        'model' => 'пост',
        'plural' => 'Посты',
        'plural_model' => 'Постов',
    ],
    'actions' => [
        'create' => [
            'title' => 'Создание поста',
        ],
        'edit' => [
            'title' => 'Редактирование поста',
        ],
        'list' => [
            'title' => 'Посты',
        ],
        'view' => [
            'title' => 'Просмотр поста',
        ],
        'delete' => [
            'title' => 'Удалить пост',
        ],
        'force-delete' => [
            'title' => 'Удалить пост безвозвратно',
        ],
        'delete-bulk' => [
            'title' => 'Удалить выбранные посты',
        ],
        'force-delete-bulk' => [
            'title' => 'Удалить выбранные посты безвозвратно',
        ],
        'restore' => [
            'title' => 'Восстановить пост',
        ],
        'restore-bulk' => [
            'title' => 'Восстановить выбранные посты',
        ],
    ],
    'empty' => [
        'heading' => 'Не найдено постов',
    ],
    'filter' => [
        'published_at' => [
            'from' => [
                'label' => 'Время публикации с',
                'indicator' => 'Время публикации с: :value',
            ],
            'to' => [
                'label' => 'Время публикации до',
                'indicator' => 'Время публикации до: :value',
            ],
        ],
    ],
    'builder' => [
        'create_item_button_label' => 'Добавить блок контента',
        'block' => [
            'paragraph' => [
                'label' => 'Параграф',
            ],
            'image' => [
                'label' => 'Изображение',
            ],
            'quote' => [
                'label' => 'Цитата',
                'author' => 'Автор',
                'content' => 'Содержание цитаты',
            ],
            'html' => [
                'label' => 'Код для вставки',
            ],
        ],
    ],
];
