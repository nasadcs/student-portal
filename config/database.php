<?php
// Подключение к базе данных (MySQL через XAMPP)
$host = "localhost";
$user = "root";
$password = "";
$dbname = "student_portal";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>
