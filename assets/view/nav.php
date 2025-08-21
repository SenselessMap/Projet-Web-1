<?php
session_start();
//nav.php
//Va dependre de si on est connect/ ou non
$basePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);
$root = '/maquette2'; // adjustement
?>

<nav class="nav flex_row">
    <input type="checkbox" id="nav-toggle" class="burger-checkbox">
    <label for="nav-toggle" class="burger mobile" aria-label="Toggle menu">☰</label>

    <ul class="nav-liens desktop flex_row">
        <li><a href="<?= $root ?>/index.php">Accueil</a></li>

        <li class="nav-item dropdown">
            <a href="<?= $root ?>/assets/html/enchere.php">Enchère <span class="dropdown-fleche">▾</span></a>
            <ul class="dropdown-menu">
                <li><a href="<?= $root ?>/assets/html/enchere.php">Toutes les enchères</a></li>
                <li><a href="<?= $root ?>/assets/html/enchere.php">Futures enchères</a></li>
                <li><a href="<?= $root ?>/assets/html/enchere.php">Histoire du Québec</a></li>
                <li><a href="<?= $root ?>/assets/html/enchere.php">Timbre de l'Est</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a href="<?= $root ?>/assets/html/enchere.php">Membre <span class="dropdown-fleche">▾</span></a>
            <ul class="dropdown-menu">
                <li><a href="<?= $root ?>/assets/html/inscriptions.php">Inscriptions</a></li>
                <li><a href="<?= $root ?>/assets/html/expositions.php">Expositions</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a href="<?= $root ?>/assets/html/education.php">Éducation <span class="dropdown-fleche">▾</span></a>
            <ul class="dropdown-menu">
                <li><a href="<?= $root ?>/assets/html/initiative.php">Initiative "Collection de demain"</a></li>
                <li><a href="<?= $root ?>/assets/html/presentations2025.php">Présentations 2025</a></li>
                <li><a href="<?= $root ?>/assets/html/presentations2026.php">Présentations 2026</a></li>
            </ul>
        </li>

        <li><a href="<?= $root ?>/assets/html/actualites.php">Actualités</a></li>
        <li><a href="<?= $root ?>/assets/html/contact.php">Contact</a></li>
    </ul>

    <ul class="nav-right flex_row">
        <?php if (!empty($_SESSION['user'])): ?>
            <li class="nav-item"><a href="<?= $root ?>/assets/html/profile.php">Profil</a></li>
            <li class="nav-item"><a href="<?= $root ?>/assets/php/logout.php">Déconnexion</a></li>
        <?php else: ?>
            <li class="nav-item"><a href="<?= $root ?>/assets/html/connexion.php">Connexion</a></li>
            <li class="nav-item"><a href="<?= $root ?>/assets/html/register.php">Créer un compte</a></li>
        <?php endif; ?>
    </ul>
</nav>
