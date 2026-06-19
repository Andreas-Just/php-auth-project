<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once 'config/database.php';
$pdo = getDB();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $bio   = trim($_POST['bio'] ?? '');

    if ($name) {
        $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, bio = ? WHERE id = ?");
        $stmt->execute([$name, $email, $bio, $_SESSION['user_id']]);
        $_SESSION['user_name'] = $name;
        $message = 'Профиль обновлён.';
    } else {
        $message = 'Имя не может быть пустым.';
    }
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Редактирование профиля</h1>
            <a href="logout.php" class="btn-logout">Выйти</a>
        </div>
        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <form method="POST">
            <label>Имя
                <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
            </label>
            <label>Email
                <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
            </label>
            <label>О себе
                <textarea name="bio"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
            </label>
            <button type="submit">Сохранить</button>
        </form>
        <a href="dashboard.php">← Назад на Dashboard</a>
    </div>
</body>
</html>
