<?php
require_once "includes/header.php";
require_once "includes/flash.php";
?>
<section class="hero">
    <h1>Добро пожаловать на портал студентов</h1>
    <p>Личный кабинет для просмотра профиля, дисциплин, оценок и учебной информации.</p>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="hero-actions">
            <a class="btn btn-primary" href="login.php">Войти</a>
            <a class="btn btn-secondary" href="register.php">Регистрация</a>
        </div>
    <?php else: ?>
        <a class="btn btn-primary" href="profile.php">Перейти в профиль</a>
    <?php endif; ?>
</section>
<?php require_once "includes/footer.php"; ?>
