<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../helpers/functions.php";

requireLogin();

$stmt = $pdo->prepare("SELECT * FROM students");
$stmt->execute();
$students = $stmt->fetchAll();
$c = count($students);
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="bg-gray-900 text-white min-h-screen">
    <div class="container mx-auto px-6 py-12">
        <header class="mb-8">
            <h1 class="text-4xl font-bold">Students</h1>
            <p class="text-gray-400">Manage and browse all student records<span class="ml-2 text-gray-500">(<?= e((string)$c) ?>)</span></p>
        </header>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div class="relative w-full md:max-w-md">
                <input id="studentSearch" type="text" placeholder="Search by name, email, or course" class="w-full px-4 py-3 rounded-lg bg-gray-800 border border-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="filterStudents()" />
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">🔎</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?= BASE_URL ?>/students/add.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-5 rounded-lg shadow transition">Add Student</a>
                <a href="<?= BASE_URL ?>/dashboard.php" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-3 px-5 rounded-lg shadow transition">Back to Dashboard</a>
            </div>
        </div>

        <div id="studentsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($students as $student): ?>
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 flex flex-col" data-name="<?= e($student['name']) ?>" data-email="<?= e($student['email']) ?>" data-course="<?= e($student['course']) ?>">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <div class="text-blue-400 text-2xl mb-1">🎓</div>
                            <h3 class="text-xl font-semibold text-blue-300 leading-tight"><?= e($student['name']) ?></h3>
                        </div>
                        <div class="flex gap-2">
                            <a href="<?= BASE_URL ?>/students/edit.php?id=<?= urlencode($student['id']) ?>" class="px-3 py-1.5 bg-blue-500 hover:bg-blue-600 rounded text-sm">Edit</a>
                            <a href="<?= BASE_URL ?>/students/delete.php?id=<?= urlencode($student['id']) ?>" class="px-3 py-1.5 bg-red-500 hover:bg-red-600 rounded text-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                        </div>
                    </div>
                    <div class="text-sm">
                        <p class="mb-1"><span class="font-semibold text-gray-400">Email:</span> <?= e($student['email']) ?></p>
                        <p class="mb-1"><span class="font-semibold text-gray-400">Phone:</span> <?= e($student['phone']) ?></p>
                        <p class="mb-1"><span class="font-semibold text-gray-400">Course:</span> <?= e($student['course']) ?></p>
                        <p class="mb-1"><span class="font-semibold text-gray-400">Created At:</span> <?= e($student['created_at']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($students)): ?>
            <div id="noStudents" class="text-center text-gray-400 mt-10">No students found.</div>
        <?php else: ?>
            <div id="noStudents" class="text-center text-gray-400 mt-10 hidden">No matching students.</div>
        <?php endif; ?>

        <script>
            function filterStudents() {
                const q = (document.getElementById('studentSearch').value || '').toLowerCase();
                const cards = document.querySelectorAll('#studentsGrid > div');
                let shown = 0;
                cards.forEach(card => {
                    const name = (card.getAttribute('data-name') || '').toLowerCase();
                    const email = (card.getAttribute('data-email') || '').toLowerCase();
                    const course = (card.getAttribute('data-course') || '').toLowerCase();
                    const match = !q || name.includes(q) || email.includes(q) || course.includes(q);
                    card.style.display = match ? '' : 'none';
                    if (match) shown++;
                });
                const noEl = document.getElementById('noStudents');
                if (noEl) {
                    noEl.classList.toggle('hidden', shown !== 0);
                }
            }
        </script>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
