<?php
require_once __DIR__ . '/../config/paths.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../config/db.php';

requireLogin();

// Validate and fetch the ID
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
	flash('error', 'Invalid student id.');
	header('Location: ' . BASE_URL . '/students/list.php');
	exit;
}

try {
	// Optionally ensure record exists first
	$check = $pdo->prepare('SELECT id FROM students WHERE id = :id');
	$check->execute([':id' => $id]);
	if (!$check->fetch()) {
		flash('error', 'Student not found.');
		header('Location: ' . BASE_URL . '/students/list.php');
		exit;
	}

	// Delete the student
	$stmt = $pdo->prepare('DELETE FROM students WHERE id = :id');
	$stmt->execute([':id' => $id]);

	flash('success', 'Student deleted successfully.');
} catch (Throwable $e) {
	flash('error', 'Failed to delete student.');
}

header('Location: ' . BASE_URL . '/students/list.php');
exit;
