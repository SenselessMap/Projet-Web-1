<?php
// DB connection setup (adjust user/password/host if needed)
$host = 'localhost';
$dbname = 'projet_web_1';
$user = 'root';
$pass = '';  // your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Error connecting to DB: ' . $e->getMessage());
}

// Get POST data from form
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Basic validation
if (!$email || !$password) {
    die('Please fill both email and password.');
}

// Prepare and execute query to find user by email
$stmt = $pdo->prepare('SELECT * FROM User WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    if (password_verify($password, $user['password'])) { // pour le hashing ($password === $user['password'])
        echo "Login successful! Welcome, " . htmlspecialchars($user['name']) . ".";
    } else {
        echo "Wrong password.";
    }
} else {
    echo "User not found.";
}
?>
