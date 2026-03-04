<?php

require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // fixe le tout
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$name || !$email || !$password) {
        die('Tous les champs sont requis.');
    }

    // Check si le user exist ici
    $stmt = $pdo->prepare("SELECT user_id FROM User WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        die('Cet email est déjà utilisé.');
    }

    // Hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $insert = $pdo->prepare("INSERT INTO User (email, password, name) VALUES (?, ?, ?)");
    $success = $insert->execute([$email, $hashedPassword, $name]);

    if ($success) {
        echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        // header("Location: ../html/connexion.html");
        // exit;
    } else {
        echo "Erreur lors de l'inscription. Veuillez réessayer.";
    }
} else {
    echo "Méthode HTTP non supportée.";
}
?>
