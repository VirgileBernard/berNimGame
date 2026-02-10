<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>BernimGame</title>
</head>
<body>

<h1>berNimGame</h1>
<?php var_dump($messages) ?>

      <div class="themeToggle">
    <button id="themeToggleBtn" class="toggle-btn">
        <i class="fa-solid fa-moon"></i>
    </button>
</div>

<!-- Messages de configuration -->
<div class="messages-settings">
    <?php foreach ($messages as $msg): ?>
        <?php if ($msg['class'] === 'setting'): ?>
            <p class="message setting"><?= htmlspecialchars($msg['text']) ?></p>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?php if ($pyramide !== null && !$game_over): ?>
    <p class="tour-actuel <?= $tour ?>">
        <?php
     echo ($tour === "joueur1") ? "Votre tour" : "Tour de l'ordinateur";

        ?>
    </p>
<?php endif; ?>


<?php if ($pyramide === null): ?>
<form method="post" action="?action=start">
    <p>Choisissez la taille de la pyramide</p>
    <input type="range" name="nbLignes" min="3" max="5" step="1" value="3" id="sliderPyramide">

    <p class="txt-secondary">Taille : <span id="valeurPyramide">3</span> lignes</p>

    <div class="preview-pyramide" id="previewPyramide"></div>

    <button type="submit">Valider</button>
</form>
<?php endif; ?>

<script src="../public/script.js"></script>

</body>
</html>
