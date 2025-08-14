<?php
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ .'/../config/paths.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <nav class="container h-20 px-4 bg-gray-900 text-white">
        <div class="flex justify-between items-center h-full">
            <a class="shadow text-2xl font-bold" href="<?= BASE_URL ?>">
                Studify
            </a>
            <div>
                <a class="px-4 py-2 bg-blue-500 shadow hover:bg-blue-600 rounded mr-4" href="<?= BASE_URL ?>/dashboard.php">
                        Dashboard
                    </a>
                <?php if (isLoggedIn()): ?>
                    <a class="px-4 py-2 bg-blue-500 shadow hover:bg-blue-600 rounded" href="<?= BASE_URL ?>/auth/logout.php">
                        Logout
                    </a>
                <?php else: ?>
                    <a class="px-4 py-2 bg-blue-500 shadow hover:bg-blue-600 rounded" href="<?= BASE_URL ?>/auth/login.php">
                        Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container relative">
        <?php if ($msg = flash('success')): ?>
            <div class="absolute top-4 left-1/2 -transform-x-1/2 text-green-500"><?= e($msg) ?></div>
        <?php endif; ?>
        <?php if ($err = flash('error')): ?>
            <div class="absolute top-4 left-1/2 -transform-x-1/2 text-red-500"><?= e($err) ?></div>
        <?php endif; ?>
    </div>
</body>

</html>
