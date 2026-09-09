<?php
require_once "config/database.php";
require_once "includes/header.php";
require_once "includes/flash.php";

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: index.php");
    exit;
}

$result = mysqli_query($conn, "SELECT id, name, email, role, group_name FROM users ORDER BY id DESC");
?>
<section class="admin">
    <h2>Админ-панель: пользователи</h2>
    <table class="table">
        <thead>
            <tr><th>ID</th><th>Имя</th><th>Email</th><th>Роль</th><th>Группа</th></tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo (int)$row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                    <td><?php echo htmlspecialchars($row['group_name'] ?? '—'); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>
<?php require_once "includes/footer.php"; ?>
