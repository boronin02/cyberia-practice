<?php

return [
    'fields' => [
        'last_name' => 'Фамилия',
        'first_name' => 'Имя',
        'positions' => 'Должности',
        'image' => 'Изображение',
        'deleted_at' => 'Удалено',
        'created_at' => 'Создан',
        'updated_at' => 'Обновлен',
    ],
    'label' => [
        'model' => 'автор',
        'plural' => 'Авторы',
        'plural_model' => 'Авторов',
    ],
    'actions' => [
        'create' => [
            'title' => 'Создание автора',
        ],
        'edit' => [
            'title' => 'Редактирование автора',
        ],
        'list' => [
            'title' => 'Авторы',
        ],
        'view' => [
            'title' => 'Просмотр автора',
        ],
        'delete' => [
            'title' => 'Удалить автора',
        ],
        'force-delete' => [
            'title' => 'Удалить автора безвозвратно',
        ],
        'delete-bulk' => [
            'title' => 'Удалить выбранных авторов',
        ],
        'force-delete-bulk' => [
            'title' => 'Удалить выбранных авторов безвозвратно',
        ],
        'restore' => [
            'title' => 'Восстановить автора',
        ],
        'restore-bulk' => [
            'title' => 'Восстановить выбранных авторов',
        ],
    ],
    'empty' => [
        'heading' => 'Не найдено авторов',
    ],
];
