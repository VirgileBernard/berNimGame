<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>berNimGame</title>
</head>
<body>

<section class="gameContainer">
    
      <div class="themeToggle">
    <button id="themeToggleBtn" class="toggle-btn">
        <i class="fa-solid fa-moon"></i>
    </button>
</div>


<div class="messages-welcome">
 <p class="welcome">Welcome to</p>
 <p class="berNimGame">the berNimGame</p>
</div>

<?php if ($pyramide !== null && !$game_over): ?>
    <p class="tour-actuel <?= $tour ?>">
        <?php
     echo ($tour === "joueur1") ? "A toi de retirer des batons" : "C'est mon tour !";

        ?>
    </p>
<?php endif; ?>


<?php if ($pyramide === null): ?>
<div class="formContainer">
    <form method="post" action="?action=start">
    <p>Choisissez le nombre de lignes</p>
    <input type="range" name="nbLignes" min="3" max="5" step="1" value="3" id="sliderPyramide">

    <p>Taille : <span id="valeurPyramide">3</span> lignes</p>

    <div class="preview-pyramide" id="previewPyramide"></div>

    <button type="submit">Joueur</button>
</form>
</div>
<?php endif; ?>
</section>

<script src="../public/script.js"></script>

</body>
</html>
