<?php
$root = '/maquette2'; 
$stmtAuction = $pdo->prepare("SELECT auction_id FROM Auction WHERE stamp_id = ? AND status = 'En cours' ORDER BY start_date ASC LIMIT 1");
$stmtAuction->execute([$stamp['stamp_id']]);
$auction = $stmtAuction->fetch(PDO::FETCH_ASSOC);

if ($auction) {
    $stmtBid = $pdo->prepare("SELECT MAX(bid_amount) as highest_bid FROM Bid WHERE auction_id = ?");
    $stmtBid->execute([$auction['auction_id']]);
    $bidRow = $stmtBid->fetch(PDO::FETCH_ASSOC);
    $displayPrice = $bidRow['highest_bid'] ?? $stamp['starting_price'];
} else {
    $displayPrice = $stamp['starting_price'];
}
?>

<article class="grille_timbre plus_grand">
    <img src="<?= $root ?>/assets/img/timbres/<?= htmlspecialchars($stamp['image_url']) ?>"
         alt="<?= htmlspecialchars($stamp['name']) ?>" class="grille_image">
    <h4><?= htmlspecialchars($stamp['name']) ?></h4>
    <div class="flex_col flex_centered">
        <h5>$<?= number_format((float)$displayPrice, 0) ?> CAD</h5>
        <a href="<?= $root ?>/assets/html/timbre1.php?id=<?= $stamp['stamp_id'] ?>"><p>Voir</p></a>
        <?php if (!empty($_SESSION['user'])): ?>
            <a href="<?= $root ?>/assets/html/crud.php?id=<?= $stamp['stamp_id'] ?>">
                <button type="button">Modifier</button>
            </a>
        <?php endif; ?>
    </div>
</article>
