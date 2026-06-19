<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once 'config/database.php';
$pdo = getDB();
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Dashboard</h1>
            <a href="logout.php" class="btn-logout">Выйти</a>
        </div>
        <p>Добро пожаловать, <a href="profile.php"><?= htmlspecialchars($user['name']) ?></a>!</p>
        <div class="card">
            <h2>Ваши данные</h2>
            <p><strong>Логин:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email'] ?? '—') ?></p>
            <p><strong>О себе:</strong> <?= htmlspecialchars($user['bio'] ?? '—') ?></p>
        </div>
        <a href="profile.php" class="btn">Редактировать профиль</a>
    </div>
</body>
</html>
