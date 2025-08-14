<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../config/paths.php';

if (isLoggedIn()) {
    header('Location: ../dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        flash('error', 'Enter username and password');
        header('Location: login.php'); exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = :u LIMIT 1");
    $stmt->execute([':u' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['admin_username'] = $user['username'];
        flash('success', 'Logged in successfully');
        header('Location:'.BASE_URL.'/dashboard.php'); exit;
    } else {
        flash('error', 'Invalid credentials');
        header('Location: login.php'); exit;
    }
}
require_once __DIR__ . '/../includes/header.php';
$csrf = generate_csrf_token();
?>

<div class="flex items-center justify-center min-h-screen bg-gray-900 font-sans">
    <div class="max-w-md w-full mx-auto p-8 rounded-lg shadow-lg bg-gray-800 text-white">
        <h2 class="text-3xl font-bold mb-6 text-center text-blue-400">Admin Login</h2>

        <form method="post" action="login.php">
            <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">

            <div class="mb-4">
                <label for="username" class="block text-gray-400 text-sm font-semibold mb-2">Username</label>
                <input type="text" id="username" name="username" required
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-700 border-gray-600 text-white placeholder-gray-500">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-400 text-sm font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-700 border-gray-600 text-white placeholder-gray-500">
            </div>

            <button type="submit"
                    class="w-full bg-blue-500 text-white font-bold py-3 px-4 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Login
            </button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
