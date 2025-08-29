<?php
require_once __DIR__ . '/../../config.php';

// Get latest news
$stmt = $pdo->query("SELECT * FROM news ORDER BY news_id DESC LIMIT 1");
$news = $stmt->fetch(PDO::FETCH_ASSOC);

if ($news):
?>
<section class="acceuil_caroussel flex_row"><!-- Nouveauté -->
    <img src="assets/img/nouvelles/<?= htmlspecialchars($news['image_url']) ?>" 
         alt="<?= htmlspecialchars($news['title']) ?>" 
         class="acceuil_caroussel_image">

    <section class="acceuil_caroussel_texte flex_col">
        <h1><?= htmlspecialchars($news['title']) ?></h1>
        <p><?= htmlspecialchars($news['text']) ?></p>
        <a href="assets/html/enchere.php"><h4 class="right">Plus...</h4></a>
        <p class="progression"> ○ ○ ● ○ ○ </p>
    </section>
</section>
<?php
endif;
?>
