<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <title><?= $title ?? "berNimGame" ?></title>
</head>
<body>

<section class="gameContainer">

    <div class="themeToggle">
        <button id="themeToggleBtn" class="toggle-btn">
            <i class="fa-solid fa-moon"></i>
        </button>
    </div>

    <!-- Ici on injecte le contenu spécifique -->
    <?= $content ?>

    <?php if (!empty($pageScript)) : ?> <script> <?= $pageScript ?> </script> <?php endif; ?>

</section>

<script src="../public/script.js"></script>
</body>
</html>
