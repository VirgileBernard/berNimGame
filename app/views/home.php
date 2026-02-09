<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/style.css">
    <title>BernimGame</title>
</head>
<body>

<h1>berNimGame</h1>
<?php var_dump($messages) ?>

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
            if ($mode === "joueur") {
                echo ($tour === "joueur1") ? "Tour de Joueur 1" : "Tour de Joueur 2";
            } else {
                echo ($tour === "joueur1") ? "Votre tour" : "Tour de l'ordinateur";
            }
        ?>
    </p>
<?php endif; ?>


<?php if ($pyramide === null): ?>
<form method="post" action="?action=start">
    <p>Choisissez votre adversaire :</p>
    <label><input type="radio" name="mode" value="ordi"> Ordinateur</label>
    <label><input type="radio" name="mode" value="joueur"> Joueur</label>

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
