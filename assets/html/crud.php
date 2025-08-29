<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once __DIR__ . '/../../config.php';
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stampee Co</title>
        <link rel="stylesheet" href="../styles/style.css">
        <script src="../js/javascriptManager.js" type="module"></script>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=Alice&family=Limelight&family=Unica+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Unica+One:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    </head>
    <body>
        <header id="nav-container"><?php include __DIR__ . '/../view/nav.php'; ?></header><!-- session() -->

        <main>
            <?php
            if (!empty($_GET['id'])) {
                $stampId = (int) $_GET['id'];
                $stmt = $pdo->prepare("SELECT * FROM stamp WHERE stamp_id = ?");
                $stmt->execute([$stampId]);
                $stamp = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($stamp) {
                    // modifie
                    $collections = $pdo->query("SELECT id, name FROM collection ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <form id="create-stamp-form" method="POST" action="/assets/php/modifier.php" enctype="multipart/form-data">

                        <input type="hidden" name="stamp_id" value="<?= $stamp['stamp_id'] ?>">
                        <label>Nom:
                            <input type="text" name="name" value="<?= htmlspecialchars($stamp['name']) ?>" required>
                        </label>

                        <label>Description:
                            <textarea name="description" required><?= htmlspecialchars($stamp['description']) ?></textarea>
                        </label>

                        <label>Prix:
                            <input type="number" step="0.01" name="starting_price" value="<?= htmlspecialchars($stamp['starting_price']) ?>" required>
                        </label>

                        <label>Condition:
                            <input type="text" name="condition" value="<?= htmlspecialchars($stamp['condition']) ?>">
                        </label>

                        <label>Dimensions:
                            <input type="text" name="dimensions" value="<?= htmlspecialchars($stamp['dimensions']) ?>">
                        </label>

                        <label>Pays:
                            <input type="text" name="country_of_origin" value="<?= htmlspecialchars($stamp['country_of_origin']) ?>">
                        </label>

                        <label>Couleur:
                            <input type="text" name="colours" value="<?= htmlspecialchars($stamp['colours']) ?>">
                        </label>

                        <label>Collection:
                            <select name="collection" required>
                                <?php foreach ($collections as $col): ?>
                                    <option value="<?= $col['id'] ?>" <?= $col['id'] == $stamp['collection'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($col['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </label>

                        <label>Image (JPG):
                            <input type="file" name="image_url" accept=".jpg, image/jpeg">
                            <small>Actuelle: <?= htmlspecialchars($stamp['image_url']) ?></small>
                        </label>

                        <button type="submit">Modifier le timbre</button>
                    </form><?php
                } else {
                    // erreur
                }

            } else {
                // cree
                $collections = $pdo->query("SELECT id, name FROM collection ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <form id="create-stamp-form" method="POST" action="crud.php" enctype="multipart/form-data">
                    <label>Nom:
                        <input type="text" name="name" required>
                    </label>

                    <label>Description:
                        <textarea name="description" required></textarea>
                    </label>

                    <label>Prix:
                        <input type="number" step="0.01" name="starting_price" required>
                    </label>

                    <label>Condition:
                        <input type="text" name="condition">
                    </label>

                    <label>Dimensions:
                        <input type="text" name="dimensions">
                    </label>

                    <label>Pays:
                        <input type="text" name="country_of_origin">
                    </label>

                    <label>Couleur:
                        <input type="text" name="colours">
                    </label>

                    <label>Collection:
                        <select name="collection" required>
                            <?php foreach ($collections as $col): ?>
                                <option value="<?= $col['id'] ?>"><?= htmlspecialchars($col['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <label>Image (JPG):
                        <input type="file" name="image_url" accept=".jpg, image/jpeg" required>
                    </label>

                    <button type="submit">Ajouter le timbre</button>
                </form>
                <?php
            }
            ?>
        </main>
        <footer id="footer-container">
            
            <?php include __DIR__ . '/../view/footer.php'; ?> <?php //include __DIR__ . '/../view/footer.php'; ?>
        </footer>
    </body>
</html>
