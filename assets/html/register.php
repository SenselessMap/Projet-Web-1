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
        <header id="nav-container"><?php include __DIR__ . '/../view/nav.php'; ?></header>
        <main>
            <section class="login-section">j
                <h2>Inscription</h2>
                <form id="registerForm" action="../../assets/php/register.php" method="post">
                    <label for="name">Nom:</label>
                    <input type="text" id="name" name="name" required placeholder="Lord Stampee" />

                    <label for="email">Mail:</label>
                    <input type="email" id="email" name="email" required placeholder="stampee@lord.com" />

                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password" required minlength="6" placeholder="Mot de passe" />

                    <button type="submit">Inscription</button>
                </form>
            </section>
        </main>
        <footer id="footer-container">
            <?php include __DIR__ . '/../view/footer.php'; ?> <?php //include __DIR__ . '/../view/footer.php'; ?>
        </footer>
    </body>
</html>
