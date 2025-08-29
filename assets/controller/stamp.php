<?php //assets\controller\stamp.php
// assets/controller/stamp.php va aller vers index.php 
require_once __DIR__ . '/../../config.php';

try {
    $stmt = $pdo->query("SELECT * FROM stamp");
    $allStamps = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // On veux display 4 stamp seuelement
    if (count($allStamps) > 4) {
        $keys = array_rand($allStamps, 4);
        $randomStamps = [];
        foreach ($keys as $k) $randomStamps[] = $allStamps[$k];
    } else {
        $randomStamps = $allStamps; //afin de eviter la repetition
    }

    foreach ($randomStamps as $stamp) {
        include __DIR__ . '/../view/stamp.php';
    }

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}