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
                <p id="countdown">13j 2h 30m 3s</p>
            </section>
            <section class="flex_row flex_centered flex_row"> 
                <section class="flex_col">
                    <div class="catalogue_conteneur_images desktop flex_centered">
                        <section class="caroussel_timbre">
                            <img src="../img/timbres/1.jpg" alt="Timbre caroussel 1 actif" class="caroussel_timbre_image_selectione">
                            <img src="../img/timbres/1b.jpg" alt="Timbre caroussel 2" class="caroussel_timbre_image">
                            <img src="../img/timbres/1c.jpg" alt="Timbre caroussel 3" class="caroussel_timbre_image">
                        </section>
                        <img src="<?= $root ?>/assets/img/timbres/<?= htmlspecialchars($stamp['image_url']) ?>" alt="<?= htmlspecialchars($stamp['name']) ?>" class="detail_image">
                        <!--Galerie d'image Html css seulement -->        
                    </div>
                </section>
                <section class="flex_col">
                    <div class="article_conteneur">
                        <article class="catalogue_article accordion flex_col">
                            <div class="accordion-wrapper">
                                <div class="accordion-item active">
                                    <div class="accordion-header">Timbre</div>
                                    <div class="accordion-content">
                                    <section class="information">
                                        <p class="stamp-description">Timbres recouvert du Musée d'Histoire de Québec en 2001. Ce timbre a été retrouvé dans le les sous-sol du Château Frontenac par les employés lors de la rénovation des celliers. Il était pour être affiché au Musée des Civilisations d'Ottawa, mais la pandémie de 2020 a annulé les expositions et ce timbre fait parti de nombreux qui se sont retrouvé aux mains du Lord et d'autres collecteurs.</p>
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
                                        <p class="stamp-current">Offre actuelle : 204$</p>
                                        <p class="stamp-bids">Nombre de mises : 6</p>       
                                        <p class="stamp-member">Dernière mise par : IWantStamp_1337</p>           
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
<section class="miser">
    <section class="flex_row date">
        <h5>03/07/2025</h5>
        <h5>18/07/2025</h5>
    </section>

    <form method="post">
        <input type="number" name="bid_amount" min="<?= $current_bid + 1 ?>" placeholder="Entrez votre mise" required>
        <button type="submit" class="btn_miser">Miser</button>
    </form>

    <section class="flex_row">
        <h6>Dernière mise: <span>$<?= number_format($current_bid, 0) ?> CAD</span></h6>
        <img src="../img/paypal.png" alt="Information paypal">
    </section>
</section>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bid_amount'])) {
    session_start();
    if (!empty($_SESSION['user'])) {
        $user_id = $_SESSION['user']['user_id'];
        $bid_amount = (float)$_POST['bid_amount'];
        $stamp_id = (int)$stamp['stamp_id'];

        $stmt = $pdo->prepare("INSERT INTO Bid (auction_id, user_id, bid_amount, bid_date) VALUES (:auction_id, :user_id, :bid_amount, NOW())");
        $stmt->execute([
            ':auction_id' => $stamp_id,
            ':user_id' => $user_id,
            ':bid_amount' => $bid_amount
        ]);

        echo "<p>Votre mise a été placée avec succès !</p>";
    } else {
        echo "<p>Vous devez être connecté pour miser.</p>";
    }
}
                    ?>

                    <section class="flex_row">
                        <h6>Dernière mise: <span>$<?= number_format($currentBid, 0) ?></span></h6>
                        <img src="../img/paypal.png" alt="Information paypal">
                    </section>
                </section>

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
        <footer id="footer-container"></footer>
    </body>
</html>