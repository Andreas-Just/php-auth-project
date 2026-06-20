<?php
require_once __DIR__ . '/../config/database.php';

$pdo = getDB();

// Создаём таблицу пользователей (если её ещё нет)
$pdo->exec("
    CREATE TABLE IF NOT EXISTS users (
        id       INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT    UNIQUE NOT NULL,
        password TEXT    NOT NULL,
        name     TEXT    NOT NULL,
        email    TEXT,
        bio      TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");

// Создаём тестового пользователя: логин=admin, пароль=secret123
$hash = password_hash('secret123', PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT OR IGNORE INTO users (username, password, name, email) VALUES (?, ?, ?, ?)");
$stmt->execute(['admin', $hash, 'Администратор', 'admin@example.com']);

echo "База данных инициализирована.\n";
