<?php
require_once __DIR__ . '/../config.php';

$stamp_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$stmt = $pdo->prepare('SELECT * FROM Stamp WHERE stamp_id = ?');
$stmt->execute([$stamp_id]);
$stamp = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$stamp) {
    die('Timbre introuvable.');
}
$stmt2 = $pdo->prepare("SELECT MAX(bid_amount) as current_bid FROM Bid WHERE auction_id = ?");
$stmt2->execute([$stamp_id]);
$currentBidRow = $stmt2->fetch(PDO::FETCH_ASSOC);
$currentBid = $currentBidRow['current_bid'] ?? $stamp['starting_price'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="
        UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Détail du timbre</title> <!-- \assets\html\timbre1.html -->
        <link rel="stylesheet" href="../styles/style.css">
        <script src="../js/javascriptManager.js" type="module"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=Alice&family=Limelight&family=Unica+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Unica+One:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    </head>
    <body>
        <header>
            <?php include __DIR__ . '/../view/nav.php'; ?>
        </header>
        <main>
            <section>
                <ul class="breadcrumb flex_row">
                    <li><a href="../../index.html">Acceuil</a></li><li>-</li>
                    <li><a href="./enchere.html">Enchère</a></li><li>-</li>
                    <li><a href="#">Histoire du Québec</a></li><li>-</li>
                    <li><a href="#">Timbre Jaques Cartier 1855</a></li>
                </ul>
            </section>
            <section class="flex_col presentation">
                <i title="Partager" class="fas fa-share"></i>
                <h1><?= htmlspecialchars($stamp['name']) ?></h1>
                <p id="countdown"></p>

                <?php 
                    $stmtAuction = $pdo->prepare("SELECT * FROM Auction WHERE stamp_id = ?");
                    $stmtAuction->execute([$stamp_id]);
                    $auction = $stmtAuction->fetch(PDO::FETCH_ASSOC);
                    if ($auction ?? false): ?>
                    
                    <p id="countdown"></p>

                    <script>
                        const endDate = new Date("<?= $auction['end_date'] ?>").getTime();
                        const countdownEl = document.getElementById("countdown");

                        function updateCountdown() {
                            const now = new Date().getTime();
                            const diff = endDate - now;

                            if (diff <= 0) {
                                countdownEl.textContent = "Terminé";
                                clearInterval(interval);
                                return;
                            }

                            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                            countdownEl.textContent = `${days}j ${hours}h ${minutes}m ${seconds}s`;
                        }

                        updateCountdown();
                        const interval = setInterval(updateCountdown, 1000);
                    </script>
                <?php endif; ?>
            </section>
            <section class="flex_row flex_centered flex_row"> 
                <section class="flex_col">
                    <div class="catalogue_conteneur_images desktop flex_centered">

                        <?php
                        $base = $stamp['image_url'];
                        $baseName = pathinfo($base, PATHINFO_FILENAME); 
                        $ext = pathinfo($base, PATHINFO_EXTENSION); 

                        $images = ["../img/timbres/$base"];

                        $suffix = 'b';
                        while (true) {
                            $extraImage = "../img/timbres/{$baseName}{$suffix}.{$ext}";
                            if (file_exists($extraImage)) {
                                $images[] = $extraImage;
                                $suffix++;
                            } else {
                                break; 
                            }
                        }
                        ?>

                        <section class="caroussel_timbre">
                            <?php foreach ($images as $index => $img): ?>
                                <img 
                                    src="<?= htmlspecialchars($img) ?>" 
                                    alt="Timbre caroussel <?= $index + 1 ?>" 
                                    class="<?= $index === 0 ? 'caroussel_timbre_image_selectione' : 'caroussel_timbre_image' ?>">
                            <?php endforeach; ?>
                        </section>

                        <img 
                            id="detail_image"
                            src="<?= $root ?>/assets/img/timbres/<?= htmlspecialchars($stamp['image_url']) ?>" 
                            alt="<?= htmlspecialchars($stamp['name']) ?>" 
                            class="detail_image">

                    </div>

                    <script>
                    const carouselImages = document.querySelectorAll('.caroussel_timbre img');
                    const detailImage = document.getElementById('detail_image');

                    carouselImages.forEach(img => {
                        img.addEventListener('click', () => {
                            // Remove
                            const oldSelected = document.querySelector('.caroussel_timbre_image_selectione');
                            if (oldSelected) {
                                oldSelected.classList.remove('caroussel_timbre_image_selectione');
                                oldSelected.classList.add('caroussel_timbre_image');
                            }

                            // Add
                            img.classList.add('caroussel_timbre_image_selectione');
                            img.classList.remove('caroussel_timbre_image');

                            // Update
                            detailImage.src = img.src;
                        });
                    });
                    </script>
                </section>
                <section class="flex_col">
                    <div class="article_conteneur">
                        <article class="catalogue_article accordion flex_col">
                            <div class="accordion-wrapper">
                                <div class="accordion-item active">
                                    <div class="accordion-header">Timbre</div>
                                    <div class="accordion-content">
                                    <section class="information">
                                <p class="stamp-description"><?= htmlspecialchars($stamp['description'] ?? '') ?></p>
                                <p class="stamp-start">Prix de départ : $<?= number_format((float)$stamp['starting_price'], 0) ?> CAD</p>
                                <p class="stamp-condition"><?= htmlspecialchars($stamp['condition'] ?? '') ?></p>
                                <p class="stamp-dimensions">Dimensions : <?= htmlspecialchars($stamp['dimensions'] ?? '') ?></p>
                                <p class="stamp-origin">Pays d’origine : <?= htmlspecialchars($stamp['country_of_origin'] ?? '') ?></p>
                                <p class="stamp-colors">Couleurs : <?= htmlspecialchars($stamp['colours'] ?? '') ?></p>
                                <p class="stamp-certified">Certifié : <?= isset($stamp['is_certified']) && $stamp['is_certified'] ? 'Oui' : 'Non' ?></p>
                                <p class="stamp-edition">Collection: <?= htmlspecialchars($pdo->query("SELECT name FROM collection WHERE id = " . (int)$stamp['collection'])->fetchColumn() ?? 'Unknown') ?></p>
                                    </section>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <div class="accordion-header">Enchère</div>
                                    <div class="accordion-content">
                                        <section class="information">
                                            <?php
                                                $stmtAuction = $pdo->prepare("SELECT * FROM Auction WHERE stamp_id = ? AND status = 'En cours' ORDER BY start_date ASC LIMIT 1");

                                                $stmtAuction->execute([$stamp_id]);
                                                $auction = $stmtAuction->fetch(PDO::FETCH_ASSOC);

                                                if ($auction) {
                                                    $auction_id = $auction['auction_id'];
                                                    
                                                    $stmtBids = $pdo->prepare("
                                                        SELECT b.bid_amount, b.bid_date, u.name 
                                                        FROM Bid b
                                                        JOIN User u ON b.user_id = u.user_id
                                                        WHERE b.auction_id = ?
                                                        ORDER BY b.bid_amount DESC, b.bid_date DESC
                                                    ");
                                                    $stmtBids->execute([$auction_id]);
                                                    $bids = $stmtBids->fetchAll(PDO::FETCH_ASSOC);

                                                    if ($bids) {
                                                        $currentBid = $bids[0]['bid_amount'];
                                                        $lastBidder = $bids[0]['name'];
                                                        $numBids = count($bids);
                                                    } else {
                                                        $currentBid = $stamp['starting_price'];
                                                        $lastBidder = 'Personne';
                                                        $numBids = 0;
                                                    }

                                                } else {
                                                    $currentBid = $stamp['starting_price'];
                                                    $lastBidder = 'Personne';
                                                    $numBids = 0;
                                                }
                                            ?>
                                            <p class="stamp-current">
                                                Offre actuelle : $<?= number_format($currentBid, 0) ?> CAD
                                            </p>
                                            <p class="stamp-bids">
                                                Nombre de mises : <?= $numBids ?>
                                            </p>       
                                            <p class="stamp-member">
                                                Dernière mise par : <?= htmlspecialchars($lastBidder) ?>
                                            </p>           
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </article><!--Fin acordeon -->
                    </div>
                </section><!--Fin de la section des timbres-->
            </section>
            <section class="flex_row caroussel_plus flex_centered">
                <section class="flex_col colonne_plus">

                    <?php
                    $stmtAuction = $pdo->prepare("SELECT * FROM Auction WHERE stamp_id = ?");
                    $stmtAuction->execute([$stamp_id]);
                    $auction = $stmtAuction->fetch(PDO::FETCH_ASSOC);

                    if ((isset($_SESSION['user_id']) || isset($_SESSION['user']['user_id'])) && $auction) :
                    ?>
                        <section class="miser">
                            <section class="flex_row date">
                                <h5><?= isset($auction['start_date']) ? date('d/m/Y', strtotime($auction['start_date'])) : 'N/A' ?></h5>
                                <h5><?= isset($auction['end_date']) ? date('d/m/Y', strtotime($auction['end_date'])) : 'N/A' ?></h5>
                            </section>

                            <form method="post">
                                <input type="number" name="bid_amount" min="<?= $currentBid + 1 ?>" placeholder="Entrez votre mise" required>
                                <button type="submit" class="btn_miser">Miser</button>
                            </form>

                            <section class="flex_row">
                                <h6>Dernière mise: <span>$<?= number_format($currentBid, 0) ?> CAD</span></h6>
                                <img src="../img/paypal.png" alt="Information paypal">
                            </section>
                        </section>
                    <?php endif; ?>

                    <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bid_amount'])) {
                            if (!empty($_SESSION['user']) && isset($auction['auction_id'])) {
                                $user_id = $_SESSION['user']['user_id'];
                                $bid_amount = (float)$_POST['bid_amount'];

                                if ($bid_amount > $currentBid) {
                                    $stmt = $pdo->prepare("INSERT INTO Bid (auction_id, user_id, bid_amount, bid_date) VALUES (:auction_id, :user_id, :bid_amount, NOW())");
                                    $stmt->execute([
                                        ':auction_id' => $auction['auction_id'],
                                        ':user_id' => $user_id,
                                        ':bid_amount' => $bid_amount
                                    ]);
                                    echo "<p>Votre mise a été placée avec succès !</p>";
                                } else {

                                }
                            } else {
                                echo "<p>Vous devez être connecté pour miser.</p>";
                            }
                        }
                    ?>

                    <section class="annonce">
                        <h6>Ce timbre fait partie de la nouvelle collection Histoire du Québec</h6>
                        <p>Cette nouvelle collection regroupe plus de 201 timbres racontant l'histoire du Québec</p>
                        <a href="./enchere.html" ><h4 class="right">Voir le reste de la collection...</h4></a>
                    </section>
                </section>
                <section class="flex_col">
                    <section class="flex_row"><h2>Voir aussi</h2></section>
                    <hr class="separation">
                    <section class="flex_row flex_centered">
                        <?php include '../controller/stamp.php'; ?>
                    </section>
                </section>
            </section>
        </main>
        <footer id="footer-container">
            <?php include __DIR__ . '/../view/footer.php'; ?> <?php //include __DIR__ . '/../view/footer.php'; ?>
        </footer>
    </body>
</html>