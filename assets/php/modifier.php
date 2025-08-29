<?php
    session_start();
    require_once __DIR__ . '/../config.php';

    // doit etrelogin
    if (empty($_SESSION['user'])) {
        die('Vous devez être connecté pour modifier un timbre.');
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('Méthode HTTP non supportée.');
    }

    $stamp_id = $_POST['stamp_id'] ?? null;
    if (!$stamp_id) {
        die('ID du timbre manquant.');
    }

    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $starting_price = $_POST['starting_price'] ?? '';
    $condition = $_POST['condition'] ?? null;
    $dimensions = $_POST['dimensions'] ?? null;
    $country_of_origin = $_POST['country_of_origin'] ?? null;
    $colours = $_POST['colours'] ?? null;
    $collection = $_POST['collection'] ?? null;
    $is_certified = $_POST['is_certified'] ?? 0;

    if (!$name || !$description || !$starting_price) {
        die('Nom, description et prix sont requis.');
    }

    $targetDir = __DIR__ . '/../img/timbres/';
    $imageFile = $stamp_id . '.jpg';

    if (!empty($_FILES['image_url']['name'])) {
        move_uploaded_file($_FILES['image_url']['tmp_name'], $targetDir . $imageFile);
    } else {
        if (!file_exists($targetDir . $imageFile)) {
            copy(__DIR__ . '/../img/timbres/default.jpg', $targetDir . $imageFile);
        }
    }
    $stmt = $pdo->prepare("
        UPDATE Stamp SET 
            name = ?, 
            description = ?, 
            starting_price = ?, 
            `condition` = ?, 
            dimensions = ?, 
            country_of_origin = ?, 
            colours = ?, 
            is_certified = ?, 
            collection = ?, 
            image_url = ?
        WHERE stamp_id = ?
    ");

    $stmt->execute([
        $name,
        $description,
        $starting_price,
        $condition,
        $dimensions,
        $country_of_origin,
        $colours,
        $is_certified,
        $collection,
        $imageFile,
        $stamp_id
    ]);
    header("Location: ../html/crud.php?success=1");
    exit; 
?>