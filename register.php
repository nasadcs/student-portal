<?php
require_once "includes/header.php";
require_once "includes/flash.php";
?>
<section class="form-page">
    <h2>Регистрация</h2>
    <form action="actions/process_register.php" method="POST" class="form">
        <label for="name">Имя</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="group_name">Группа</label>
        <input type="text" id="group_name" name="group_name" placeholder="24-2">

        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" required minlength="6">

        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>
</section>
<?php require_once "includes/footer.php"; ?>
