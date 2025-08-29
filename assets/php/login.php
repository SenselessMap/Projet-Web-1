<?php
session_start();
//test@test.test et mot de passe est testtest
// DB connection
require_once __DIR__ . '/../config.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    $_SESSION['login_error'] = 'Please fill both email and password.';
    header('Location: ../../assets/html/connexion.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM User WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    // Login successful
    $_SESSION['user'] = [
        'user_id' => $user['user_id'],
        'name' => $user['name'],
        'email' => $user['email']
    ];
    header('Location: ../../index.php'); // redirect a acceuil
    exit;
} else {
    // Login failed
    $_SESSION['login_error'] = 'Email or password incorrect.';
    header('Location: ../../assets/html/connexion.php');
    exit;
}
