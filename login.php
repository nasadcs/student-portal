<?php
require_once "includes/header.php";
require_once "includes/flash.php";
?>
<section class="form-page">
    <h2>Авторизация</h2>
    <form action="actions/process_login.php" method="POST" class="form">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</section>
<?php require_once "includes/footer.php"; ?>
