<?php
require_once "config/database.php";
require_once "includes/header.php";
require_once "includes/flash.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = mysqli_prepare($conn, "SELECT name, email, role, group_name, created_at FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

$subjects_stmt = mysqli_prepare($conn, "
    SELECT s.title, ss.grade
    FROM student_subjects ss
    JOIN subjects s ON s.id = ss.subject_id
    WHERE ss.user_id = ?
");
mysqli_stmt_bind_param($subjects_stmt, "i", $user_id);
mysqli_stmt_execute($subjects_stmt);
$subjects_result = mysqli_stmt_get_result($subjects_stmt);
?>
<section class="profile">
    <h2>Личный кабинет</h2>
    <div class="profile-card">
        <p><strong>Имя:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Группа:</strong> <?php echo htmlspecialchars($user['group_name'] ?? '—'); ?></p>
        <p><strong>Роль:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
        <p><strong>Дата регистрации:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
    </div>

    <h3>Мои дисциплины</h3>
    <table class="table">
        <thead>
            <tr><th>Дисциплина</th><th>Оценка</th></tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($subjects_result) === 0): ?>
                <tr><td colspan="2">Дисциплины пока не назначены</td></tr>
            <?php else: while ($row = mysqli_fetch_assoc($subjects_result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['grade'] ?? '—'); ?></td>
                </tr>
            <?php endwhile; endif; ?>
        </tbody>
    </table>
</section>
<?php require_once "includes/footer.php"; ?>
