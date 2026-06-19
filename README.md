# PHP Auth Project

Учебный проект: система авторизации на PHP + SQLite.

## Запуск

1. Инициализировать базу данных:
   ```
   php database/init.php
   ```
2. Запустить встроенный сервер PHP:
   ```
   php -S localhost:8000
   ```
3. Открыть в браузере: http://localhost:8000

## Тестовый пользователь

- Логин: `admin`
- Пароль: `secret123`

## Структура

```
index.php       — страница входа
dashboard.php   — главная страница после входа
profile.php     — редактирование профиля
logout.php      — выход из системы
config/         — подключение к БД
database/       — инициализация SQLite
css/            — стили
```
