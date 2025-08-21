<?php
$host = 'localhost';
$dbname = 'projet_web_1';
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('DB connection error: ' . $e->getMessage());
}

$stmt = $pdo->query('SELECT * FROM Stamp ORDER BY stamp_id ASC');
$stamps = $stmt->fetchAll(PDO::FETCH_ASSOC);

$counter = 0;
foreach ($stamps as $stamp) {
    if ($counter % 4 == 0) {
        if ($counter > 0) {
            echo "</section>\n";
        }
        echo '<section class="flex_row flex_centered second">' . "\n"; 
    }

    include __DIR__ . '/stamp.php';
    echo "\n"; 

    $counter++;
}

if ($counter > 0) {
    echo "</section>\n"; 
}
?>

?>
