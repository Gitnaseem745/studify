<?php
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/paths.php';
?>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    
    $q = $pdo->prepare('INSERT into students (name, email, phone, course) VALUES (:n, :m, :p, :c)');
    
    if ($q->execute([':n' => $name, ':m' => $email, ':p' => $phone, ':c' => $course])
    ) {
        flash('success', 'Student added successfully!');
        header('Location:'.BASE_URL);
        exit;
    } else {
        flash('error', 'Failed to add student. please try again.');
        header('Location:'.BASE_URL.'/add.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
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

    <form method="post" action="./add.php"
        class="my-10 max-w-md mx-auto p-8 rounded-lg shadow-lg bg-gray-800 text-white">
        <h2 class="text-3xl font-bold mb-6 text-center text-blue-400">Add a New Student</h2>

        <div class="mb-4">
            <label for="name" class="block text-gray-400 text-sm font-semibold mb-2">Student Name</label>
            <input type="text" id="name" name="name" placeholder="Enter full name"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-700 border-gray-600 text-white">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-400 text-sm font-semibold mb-2">Student Email</label>
            <input type="email" id="email" name="email" placeholder="Enter email address"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-700 border-gray-600 text-white">
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-400 text-sm font-semibold mb-2">Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter phone number"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-700 border-gray-600 text-white">
        </div>

        <div class="mb-4">
            <label for="course" class="block text-gray-400 text-sm font-semibold mb-2">Course</label>
            <input type="text" id="course" name="course" placeholder="Enter course name"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-700 border-gray-600 text-white">
        </div>

        <button type="submit" name="submit"
            class="w-full bg-blue-500 text-white font-bold py-3 px-4 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Add Student
        </button>
    </form>
</body>

</html>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
