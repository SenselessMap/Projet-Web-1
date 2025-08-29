<?php
require_once __DIR__ . '/../../config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$sort = $_GET['sort'] ?? 'default';
$orderBy = '';

switch ($sort) {
    case 'price_asc':
        $orderBy = 'ORDER BY s.starting_price ASC';
        break;
    case 'price_desc':
        $orderBy = 'ORDER BY s.starting_price DESC';
        break;
    default:
        $orderBy = 'ORDER BY a.auction_id DESC'; 
        break;
}

$stmt = $pdo->query("
    SELECT a.auction_id, s.stamp_id, s.name, s.starting_price, s.image_url
    FROM auction a
    JOIN stamp s ON a.stamp_id = s.stamp_id
    $orderBy
");
$auctions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enchère</title> 
        <link rel="stylesheet" href="../styles/style.css">
        <script src="../js/javascriptManager.js" type="module"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=Alice&family=Limelight&family=Unica+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Unica+One:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    </head>
    <body>
        <header id="nav-container">
            <?php include __DIR__ . '/../view/nav.php'; ?>
        </header>
        <main>
            <section>
                <ul class="breadcrumb flex_row">
                    <li><a href="../../index.html">Acceuil</a></li><li>-</li>
                    <li><a href="./enchere.html">Enchère</a></li>
                </ul>
            </section>
            <section class="flex_row flex_centered menu_filtre">
                <section class="flex_col">
                    <h1>Parcourez nos timbres</h1>
                    <section class="flex_row">
                        <nav class="nav flex_row">
                            <ul class="nav-liens desktop flex_row ajustement_recherche"><!--
                                <li><a href="#" class="categorie">Histoire du Québec</a></li>
                                <li><a href="#" class="categorie">Collection Stampee</a></li>
                                <li><a href="#" class="categorie">Timbres de l'Est</a></li>--><!--
                                <li class="nav-item dropdown">
                                    <a href="#">Disponibilité <span class="dropdown-fleche">▾</span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">En cours</a></li>
                                        <li><a href="#">Futur enchère</a></li>
                                        <li><a href="#">Enchère archivée</a></li>
                                    </ul>
                                </li>-->
                                <li class="nav-item dropdown">
                                <li class="nav-item dropdown">
                                    <a href="#">Prix <span class="dropdown-fleche">▾</span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="enchere.php?sort=price_asc">Moins cher au plus cher</a></li>
                                        <li><a href="enchere.php?sort=price_desc">Plus cher au moins cher</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <form class="recherche" method="get" action="send">
                                <input type="text" class="recherche__input" name="s" placeholder="Rechercher...">
                                <button type="submit" class="recherche_image">
                                    <img src="https://s2.svgbox.net/hero-outline.svg?ic=search&amp;color=000" width="20" height="20" alt="Rechercher">
                                </button>
                            </form>
                        </nav>
                    </section>
                </section>
            </section>
            <section class="flex_row fin catalogue_collection">
                <section class="flex_col">
                    <section class="flex_row flex_centered second ajustement">
                        <?php include __DIR__ . '/../view/collection.php'; ?>
                    </section>
                </section>
            </section>
        </main>
        <footer id="footer-container">
            <?php include __DIR__ . '/../view/footer.php'; ?> <?php //include __DIR__ . '/../view/footer.php'; ?>
        </footer>
    </body>
</html>