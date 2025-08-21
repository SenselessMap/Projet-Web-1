<?php
//logout.php
session_start();
/*
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method.");
}
*/
$_SESSION = [];
session_destroy();

// On mange les cookie ici
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
$redirect = $_SERVER['HTTP_REFERER'] ?? '/maquette2/index.php';
header("Location: $redirect");
exit;
