<?php
require_once "../config/database.php";
session_start();

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    $_SESSION['flash_error'] = "Введите email и пароль.";
    header("Location: ../login.php");
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT id, name, password, role FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['role'] = $user['role'];
    header("Location: ../profile.php");
} else {
    $_SESSION['flash_error'] = "Неверный email или пароль.";
    header("Location: ../login.php");
}
exit;
?>
