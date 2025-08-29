<?php
require_once __DIR__ . '/../config.php';
try {
    $stmt = $pdo->query("
        SELECT s.*
        FROM Stamp s
        JOIN Auction a ON s.stamp_id = a.stamp_id
        WHERE a.status = 'En cours'
    ");

    $ongoingStamps = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($ongoingStamps) {
        // Pick 1 timbre random qui est "En cours"
        $randomKey = array_rand($ongoingStamps);
        $stamp = $ongoingStamps[$randomKey];

        include __DIR__ . '/../view/stamp.php';
    } else {
        echo "<p>Aucune enchère en cours pour le moment.</p>";
    }

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}