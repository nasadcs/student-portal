<?php
require_once "../config/database.php";
session_start();

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$group_name = trim($_POST['group_name'] ?? '');
$password = $_POST['password'] ?? '';

if ($name === '' || $email === '' || $password === '') {
    $_SESSION['flash_error'] = "Заполните все обязательные поля.";
    header("Location: ../register.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['flash_error'] = "Некорректный email.";
    header("Location: ../register.php");
    exit;
}

if (strlen($password) < 6) {
    $_SESSION['flash_error'] = "Пароль должен быть не короче 6 символов.";
    header("Location: ../register.php");
    exit;
}

$check = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
mysqli_stmt_bind_param($check, "s", $email);
mysqli_stmt_execute($check);
mysqli_stmt_store_result($check);

if (mysqli_stmt_num_rows($check) > 0) {
    $_SESSION['flash_error'] = "Пользователь с таким email уже существует.";
    header("Location: ../register.php");
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password, group_name, role) VALUES (?, ?, ?, ?, 'student')");
mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashed_password, $group_name);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['flash_success'] = "Регистрация успешно выполнена. Теперь войдите.";
    header("Location: ../login.php");
} else {
    $_SESSION['flash_error'] = "Ошибка регистрации. Попробуйте снова.";
    header("Location: ../register.php");
}
exit;
?>
