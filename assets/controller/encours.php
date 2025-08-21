<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=projet_web_1", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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