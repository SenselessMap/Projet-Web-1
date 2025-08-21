<?php
//session_start();
$basePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);
$root = '/maquette2'; 
?>
<footer class="ajustement_footer">
    <section class="footer_top">
        <div class="flex_row">
            <div class="flex_col">
                <a href="<?= $root ?>/index.php"><h3>Accueil</h3></a>
                <a href="<?= $root ?>/assets/html/enchere.php"><h3>Enchères</h3></a>
            </div>
            <div class="flex_col">
                <h3 class="footer_section">Collections</h3>
                <a href="<?= $root ?>/assets/html/enchere.php"><h3>Histoire du Québec</h3></a>
                <a href="<?= $root ?>/assets/html/enchere.php"><h3>Collection Stampy</h3></a>
                <a href="<?= $root ?>/assets/html/enchere.php"><h3>Timbre de l'Est</h3></a>
            </div>
            <div class="flex_col">
                <h3 class="footer_section">Membre</h3>
                <a href="<?= $root ?>/assets/html/register.php"><h3>Inscription</h3></a>
                <a href="<?= $root ?>/assets/html/expositions.php"><h3>Expositions</h3></a>
            </div>
            <div class="flex_col">
                <h3 class="footer_section">Autre</h3>
                <?php if (!empty($_SESSION['user'])): ?>
                    <a href="<?= $root ?>/assets/php/logout.php"><h3>Logout</h3></a>
                    <a href="<?= $root ?>/assets/html/contact.php"><h3>Nous contacter</h3></a>
                <?php else: ?>
                    <a href="<?= $root ?>/assets/html/register.php"><h3>Créer un compte</h3></a>
                    <a href="<?= $root ?>/assets/html/connexion.php"><h3>Se connecter</h3></a>
                    <a href="<?= $root ?>/assets/html/contact.php"><h3>Nous contacter</h3></a>
                <?php endif; ?>
            </div>
            <div class="flex_col">
                <a href="<?= $root ?>/assets/html/help.php"><h3>Besoin d'aide?</h3></a>
            </div>
            <div class="flex_col">
                <h4>Recherchez par nom:</h4>
                <form class="recherche" method="get" action="<?= $root ?>/assets/html/send.php">
                    <input type="text" class="recherche__input" name="s" placeholder="Rechercher...">
                    <button type="submit" class="recherche_image">
                        <img src="https://s2.svgbox.net/hero-outline.svg?ic=search&amp;color=000" width="20" height="20" alt="Rechercher">
                    </button>
                </form>
                <div class="socials flex_row">
                    <i class="fa-solid fa-rss"></i>
                    <i class="fa-brands fa-youtube"></i>
                    <i class="fab fa-facebook-f"></i>
                </div>
            </div>
        </div>
    </section>
    <section class="legal">
        <a><h6>Conditions d'utilisation</h6></a>
        <a><h6>@Stampee Co. 2025</h6></a>
    </section>
</footer>
