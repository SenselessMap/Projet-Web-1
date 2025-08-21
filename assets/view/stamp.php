<?php
$root = '/maquette2'; 
?>

<article class="grille_timbre plus_grand">
    <img src="<?= $root ?>/assets/img/timbres/<?= htmlspecialchars($stamp['image_url']) ?>"
         alt="<?= htmlspecialchars($stamp['name']) ?>" class="grille_image">
    <h4><?= htmlspecialchars($stamp['name']) ?></h4>
    <div class="flex_col flex_centered">
        <h5>$<?= number_format((float)$stamp['starting_price'], 0) ?> CAD</h5>
        <a href="<?= $root ?>/assets/html/timbre1.php?id=<?= $stamp['stamp_id'] ?>"><p>Voir</p></a>
    </div>
</article>
