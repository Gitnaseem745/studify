<?php
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/paths.php';

requireLogin();

// Get ID from query string or POST fallback
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if (isset($_POST['submit']) && isset($_POST['id'])) {
    $id = (int) $_POST['id'];
}

if ($id <= 0) {
    flash('error', 'Invalid student id.');
    header('Location: ' . BASE_URL . '/students/list.php');
    exit;
}

// Load existing student
try {
    $stmt = $pdo->prepare('SELECT * FROM students WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $student = $stmt->fetch();
    if (!$student) {
        flash('error', 'Student not found.');
        header('Location: ' . BASE_URL . '/students/list.php');
        exit;
    }
} catch (Throwable $e) {
    flash('error', 'Failed to load student.');
    header('Location: ' . BASE_URL . '/students/list.php');
    exit;
}


if (isset($_POST['submit'])) {
    // CSRF check
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        flash('error', 'Invalid form token. Please try again.');
        header('Location: ' . BASE_URL . '/students/edit.php?id=' . urlencode((string)$id));
        exit;
    }

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $course = trim($_POST['course'] ?? '');

    try {
        $q = $pdo->prepare('UPDATE students SET name = :n, email = :m, phone = :p, course = :c WHERE id = :id');
        $ok = $q->execute([':n' => $name, ':m' => $email, ':p' => $phone, ':c' => $course, ':id' => $id]);
        if ($ok) {
            flash('success', 'Student updated successfully.');
            header('Location: ' . BASE_URL . '/students/list.php');
            exit;
        }
        flash('error', 'Failed to update student. Please try again.');
    } catch (Throwable $e) {
        flash('error', 'Failed to update student.');
    }
}
?>

<?php require_once __DIR__ . '/../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>

<body class="bg-gray-900 font-sans">
    <div class="container mx-auto mt-8 px-4">
        <?php if ($msg = flash('success')): ?>
            <div class="bg-green-500 text-white p-4 rounded-lg shadow mb-4"><?= e($msg)?></div>
        <?php endif; ?>
        <?php if ($err = flash('error')): ?>
            <div class="bg-red-500 text-white p-4 rounded-lg shadow mb-4"><?= e($err)?></div>
        <?php endif; ?>
    </div>

    <form method="post" action="./edit.php?id=<?= urlencode($student['id']) ?>"
        class="my-10 max-w-md mx-auto p-8 rounded-lg shadow-lg bg-gray-800 text-white">
        <h2 class="text-3xl font-bold mb-6 text-center text-blue-400">Edit Student</h2>

        <div class="mb-4">
            <label for="name" class="block text-gray-400 text-sm font-semibold mb-2">Student Name</label>
            <input type="text" id="name" name="name" value="<?= e($_POST['name'] ?? $student['name']) ?>"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-700 border-gray-600 text-white">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-400 text-sm font-semibold mb-2">Student Email</label>
            <input type="email" id="email" name="email" value="<?= e($_POST['email'] ?? $student['email']) ?>"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-700 border-gray-600 text-white">
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-400 text-sm font-semibold mb-2">Phone Number</label>
            <input type="tel" id="phone" name="phone" value="<?= e($_POST['phone'] ?? $student['phone']) ?>"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-700 border-gray-600 text-white">
        </div>

        <div class="mb-4">
            <label for="course" class="block text-gray-400 text-sm font-semibold mb-2">Course</label>
            <input type="text" id="course" name="course" value="<?= e($_POST['course'] ?? $student['course']) ?>"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-700 border-gray-600 text-white">
        </div>

        <input type="hidden" name="id" value="<?= (int) $student['id'] ?>">
    <input type="hidden" name="csrf_token" value="<?= e(generate_csrf_token()) ?>">

        <button type="submit" name="submit"
            class="w-full bg-blue-500 text-white font-bold py-3 px-4 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Edit Student
        </button>
    </form>
</body>

</html>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
