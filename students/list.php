<?php
require_once __DIR__ . "/../config/db.php";

$stmt = $pdo->prepare("SELECT * FROM students");
$stmt->execute();
$students = $stmt->fetchAll();
$c = count($students);
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="container mx-auto p-10">
    <h2 class="text-3xl font-bold mb-8 text-center text-blue-400">Students List</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($students as $student): ?>
            <div class="card bg-gray-800 text-white rounded-lg shadow-lg p-6 flex flex-col items-start">
            <div class="w-full flex justify-between items-center">
                <h3 class="text-xl font-semibold mb-2 text-blue-300"><?= e($student['name']) ?></h3>
                <div class="flex gap-4 justify-between items-center">
                    <a href="<?= BASE_URL ?>/students/delete.php?id=<?= urlencode($student['id']) ?>"
                    class="bg-blue-500 px-2 py-1 rounded text-center"
                    onclick="return confirm('Are you sure you want to delete this student?');">
                    Delete
                </a>
                    <a href="<?= BASE_URL ?>/students/edit.php?id=<?= urlencode($student['id']) ?>"
                    class="bg-blue-500 px-2 py-1 rounded text-center">
                    Edit
                </a>
                </div>     
            </div>    
                <p class="mb-1"><span class="font-semibold text-gray-400">Email:</span> <?= e($student['email']) ?></p>
                <p class="mb-1"><span class="font-semibold text-gray-400">Phone:</span> <?= e($student['phone']) ?></p>
                <p class="mb-1"><span class="font-semibold text-gray-400">Course:</span> <?= e($student['course']) ?></p>
                <p class="mb-1"><span class="font-semibold text-gray-400">Created At:</span> <?= e($student['created_at']) ?></p>
            </div>
        <?php endforeach; ?>
        <?php if (empty($students)): ?>
            <div class="col-span-full text-center text-gray-400">No students found.</div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
