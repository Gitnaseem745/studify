<?php
require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/paths.php';

requireLogin();

$stmt = $pdo->query('SELECT COUNT(*) as total FROM students');
$totalStudents = $stmt->fetch()['total'];
require_once __DIR__ ."/includes/header.php";
?>

<div class="bg-gray-900 text-white min-h-screen">
    <div class="container mx-auto px-6 py-12">
        <header class="mb-10">
            <h1 class="text-4xl font-bold mb-2">Dashboard</h1>
            <p class="text-gray-400">Overview and quick actions</p>
        </header>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Stat: Total Students -->
            <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
                <div class="text-blue-400 text-3xl mb-3">👥</div>
                <div class="text-sm uppercase tracking-wide text-gray-400">Total Students</div>
                <div class="text-4xl font-extrabold mt-2"><?= e($totalStudents) ?></div>
            </div>

            <!-- Action: Add Student -->
            <a href="<?= BASE_URL ?>/students/add.php" class="bg-gray-800 p-8 rounded-lg shadow-lg hover:bg-gray-700 transition-colors">
                <div class="text-blue-400 text-3xl mb-3">➕</div>
                <div class="text-xl font-semibold">Add Student</div>
                <p class="text-gray-400 mt-1">Create a new student record.</p>
            </a>

            <!-- Action: View Students -->
            <a href="<?= BASE_URL ?>/students/list.php" class="bg-gray-800 p-8 rounded-lg shadow-lg hover:bg-gray-700 transition-colors">
                <div class="text-blue-400 text-3xl mb-3">📋</div>
                <div class="text-xl font-semibold">Students List</div>
                <p class="text-gray-400 mt-1">Browse and manage existing students.</p>
            </a>
        </section>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
