<?php
require_once __DIR__ . '/includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body class="container bg-gray-900 text-white"> 
    <header class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-7xl font-bold mb-4">Student Management, Simplified.</h1>
        <p class="text-xl md:text-2xl mb-8">Effortlessly manage students, courses, and data in one place.</p>
        <a href="<?= BASE_URL.'/auth/login.php' ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 px-8 rounded-full shadow-lg transition duration-300">
            Get Started
        </a>
    </div>
</header>

<section class="py-20 bg-gray-800 text-white">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-12">Key Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-gray-700 p-8 rounded-lg shadow-lg">
                <div class="text-blue-400 text-3xl mb-4">📚</div>
                <h3 class="text-xl font-semibold mb-2">Manage Student Records</h3>
                <p class="text-gray-400">Add, edit, and delete student information with ease.</p>
            </div>
            
            <div class="bg-gray-700 p-8 rounded-lg shadow-lg">
                <div class="text-blue-400 text-3xl mb-4">📝</div>
                <h3 class="text-xl font-semibold mb-2">Organize Courses</h3>
                <p class="text-gray-400">Create and manage courses and assign students to them.</p>
            </div>

            <div class="bg-gray-700 p-8 rounded-lg shadow-lg">
                <div class="text-blue-400 text-3xl mb-4">🔒</div>
                <h3 class="text-xl font-semibold mb-2">Secure Admin Access</h3>
                <p class="text-gray-400">Protect your data with a secure, login-based system.</p>
            </div>
            
            <div class="bg-gray-700 p-8 rounded-lg shadow-lg">
                <div class="text-blue-400 text-3xl mb-4">🔍</div>
                <h3 class="text-xl font-semibold mb-2">Search & Filter</h3>
                <p class="text-gray-400">Quickly find student records with powerful search functionality.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-blue-500 text-white text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold mb-4">Ready to get started?</h2>
        <p class="text-xl mb-8">Join thousands of schools and institutions simplifying their student data.</p>
        <a href="<?= BASE_URL.'/auth/login.php' ?>" class="bg-gray-900 hover:bg-gray-700 text-white font-bold py-4 px-8 rounded-full shadow-lg transition duration-300">
            Log In Now
        </a>
    </div>
</section>
</body>
</html>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
