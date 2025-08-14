<?php
require_once __DIR__ . '/config/db.php';
requireLogin();
$username = 'Naseem';
$password = password_hash('naseem123', PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO admin_users (username, password) VALUES (:u, :p)");
$stmt->execute([':u'=> $username, ':p'=> $password]);
echo "Admin created\n";
