<?php
// Вывод сообщений об ошибках/успехе (единая точка, без дублирования кода)
if (!empty($_SESSION['flash_error'])) {
    echo '<div class="alert alert-error">' . htmlspecialchars($_SESSION['flash_error']) . '</div>';
    unset($_SESSION['flash_error']);
}
if (!empty($_SESSION['flash_success'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['flash_success']) . '</div>';
    unset($_SESSION['flash_success']);
}
?>
