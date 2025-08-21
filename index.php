<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stampee Co</title>
        <link rel="stylesheet" href="assets/styles/style.css">
        <script src="assets/js/javascriptManager.js" type="module"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=Alice&family=Limelight&family=Unica+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Unica+One:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="topBanner" class="top-banner">
            <a href="assets/html/timbre1.php"><p>Enchère en cours pour le timbre Jaques Cartier!</p></a>
        </div>
        <header id="nav-container">
            <?php include __DIR__ . '/assets/view/nav.php'; ?> <!-- et pour les autres page on met <?php //include __DIR__ . '/../view/nav.php'; ?> -->
        </header>
        <main>
            <section class="flex_col flex_centered couleur">
                <img src="assets/img/logo.png" alt="logo de Stampee">
                <h3 class="a">Le Lord</h3>
                <p>Lord Reginald Stampee de Worcessteshear est un gentilhomme collectionneur. Étant né en 1940 il a toujours eu une fascination pour l'histoire et les musées. Il possède plusieurs collections dont une naquit de son intérêt récent pour les timbres. Après avoir mis aux enchères des momies et artéfact d'autres continents, il s'intéresse désormais à la riche histoire des timbres ayant lié des villes et pays.</p>
            </section>
            <?php include 'assets/view/new.php'; ?>
            <section class="flex_row fin">
                <section class="flex_col">
                    <section class="flex_row"><h2>Offres vedette</h2></section>
                    <hr class="separation">
                    <section class="flex_row flex_centered second">
                        <?php include 'assets/controller/stamp.php'; ?>
                    </section>
                </section>
                <section class="flex_col">
                    <section class="flex_row"><h2>Offres en cours</h2></section>
                    <hr class="separation">
                    <section class="flex_row flex_centered second">
                        <?php include __DIR__ . '/assets/controller/encours.php'; ?>
                    </section>
                </section><!-- col -->
            </section><!-- Row -->
            <section class="flex_col couleur">
                <h4 class="a">Notre mission</h4>
                <p>Permettre l'échange et le partage de la richesse historique des timbres du monde. Offrir aux passionnés une plateforme d’enchères accessible et conviviale pour enrichir leurs collections. Célébrer l’art et l’histoire à travers chaque timbre.</p><br>
                <h4 class="a">Initiative "Collection de demain"</h4>
                <p>Nous collaborons étroitement avec des musées renommés pour préserver et valoriser l’histoire des timbres. Par des expositions et des ressources pédagogiques, nous partageons la richesse culturelle des collections avec passion et rigueur. Ainsi nous passons dans les écoles pour donner des présentation sur l'histoire, permettant aux élèves d'étudier de proche des artéfactes importants.</p>
                <br>
                <hr>
                <br>
                <h4 class="centre">Nos prochaines visites éducatives</h4>
                <br>
                <section class="flex_row ajustement">
                    <article class="actualite">
                        <img src="assets/img/expo2.jpg" alt="Visite" class="actualite_image">
                        <h2>Montréal</h2>
                        <p>Musée McCord Stewart</p>
                        <p>20 septembre 2025</p>
                    </article>
                    <div class="vr"></div>
                    <article class="actualite">
                        <img src="assets/img/expo1.jpg" alt="Visite" class="actualite_image">
                        <h2>Washington, États-Unis</h2>
                        <p>National Postal Museum</p>
                        <p>2 septembre 2025</p>
                    </article>
                    <div class="vr"></div>
                    <article class="actualite">
                        <img src="assets/img/fond.jpg" alt="Visite" class="actualite_image">
                        <h2>Chateau Borély</h2>
                        <p>Musée des Arts Décoratifs, de la Faiënce et de la Mode</p>
                        <p>30 septembre 2025</p>
                    </article>
                </section>
            </section>
        </main>
        <footer id="footer-container">
            <?php include __DIR__ . '/assets/view/footer.php'; ?> <?php //include __DIR__ . '/../view/footer.php'; ?>
        </footer>
    </body>
</html>
