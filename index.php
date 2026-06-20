<?php
session_start();

// Если пользователь уже вошёл — сразу отправляем на dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

// Обрабатываем форму только когда она отправлена (метод POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config/database.php';

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $pdo  = getDB();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Логин и пароль верные — сохраняем пользователя в сессии
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Неверный логин или пароль.';
        }
    } else {
        $error = 'Введите логин и пароль.';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в систему</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Вход в систему</h1>

        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Логин
                <input type="text" name="username" required autofocus>
            </label>
            <label>Пароль
                <input type="password" name="password" required>
            </label>
            <button type="submit">Войти</button>
        </form>
    </div>
</body>
</html>
