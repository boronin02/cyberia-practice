# Локальный запуск

## Требования

- Docker + Docker Compose

## 1. Переменные окружения

Создать копию `.env` из `.env.example`

```bash
cp .env.example .env
```

## 2. Сборка и запуск контейнеров

```bash
docker compose build
docker compose up -d
```

## 3. Установка зависимостей

```bash
docker compose exec fpm composer install
docker compose exec fpm php artisan key:generate
docker compose exec fpm php artisan optimize
docker compose exec fpm php artisan migrate:fresh --seed
docker compose exec fpm php artisan storage:link
```

Приложение доступно по адресу - http://localhost:8000

API документация - http://localhost:8000/docs/api#
