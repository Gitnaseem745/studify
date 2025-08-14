<?php
require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/paths.php';

requireLogin();
$stmt = $pdo->query('SELECT COUNT(*) as total FROM students');
$totalStudents = $stmt->fetch()['total'];
require_once __DIR__ ."/includes/header.php";
?>

<div class="bg-gray-900 h-screen container text-center text-white space-y-12">
    <h2 class="text-3xl font-semibold">Dashboard</h2>
    <h2 class="text-3xl font-semibold mb-4">Total Students: <?= e($totalStudents) ?></h2>
    <a href="<?= BASE_URL ?>/students/add.php" class="bg-blue-500 rounded px-4 py-2">Add Student</a>
    <a href="<?= BASE_URL ?>/students/list.php" class="bg-blue-500 rounded px-4 py-2">Students Lists</a>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
