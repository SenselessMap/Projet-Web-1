<?php

$host = 'localhost'; //va changer pour webdev
$dbname = 'projet_web_1';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection a la bdd a /chouee : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize inputs
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$name || !$email || !$password) {
        die('Tous les champs sont requis.');
    }

    // Check if user exists
    $stmt = $pdo->prepare("SELECT user_id FROM User WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        die('Cet email est déjà utilisé.');
    }

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $insert = $pdo->prepare("INSERT INTO User (email, password, name) VALUES (?, ?, ?)");
    $success = $insert->execute([$email, $hashedPassword, $name]);

    if ($success) {
        echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        // You may redirect to login page or home here:
        // header("Location: ../html/connexion.html");
        // exit;
    } else {
        echo "Erreur lors de l'inscription. Veuillez réessayer.";
    }
} else {
    echo "Méthode HTTP non supportée.";
}
?>
