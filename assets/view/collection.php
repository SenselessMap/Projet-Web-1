<?php
$sort = $_GET['sort'] ?? 'default';
$orderBy = match($sort) {
    'price_asc'  => 'starting_price ASC',
    'price_desc' => 'starting_price DESC',
    default      => 'stamp_id ASC',
};

$stmt = $pdo->query("SELECT * FROM stamp ORDER BY $orderBy");
$stamps = $stmt->fetchAll(PDO::FETCH_ASSOC);

$counter = 0;
foreach ($stamps as $stamp) {
    if ($counter % 4 == 0) {
        if ($counter > 0) echo "</section>\n";
        echo '<section class="flex_row flex_centered second">' . "\n";
    }

    include __DIR__ . '/stamp.php';
    echo "\n";
    $counter++;
}

if ($counter > 0) echo "</section>\n";
?>
