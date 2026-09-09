<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет студента</title>
    <link rel="stylesheet" href="/student_portal/assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <a href="/student_portal/index.php" class="logo">Student Portal</a>
        <nav>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/student_portal/profile.php">Профиль</a>
                <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
                    <a href="/student_portal/admin.php">Админ-панель</a>
                <?php endif; ?>
                <a href="/student_portal/logout.php">Выйти</a>
            <?php else: ?>
                <a href="/student_portal/login.php">Войти</a>
                <a href="/student_portal/register.php">Регистрация</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">
