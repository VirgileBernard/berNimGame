<?php ob_start(); ?>

<?php if ($pyramide === null): ?>
<div class="formContainer">

    <form id="formStart" method="post" action="?action=start">

        <p class="messages-jeu">Choisis le nombre de lignes</p>

        <input type="range"
               name="nbLignes"
               min="3"
               max="5"
               step="1"
               value="3"
               id="sliderPyramide"
               class="sliderPyramide">

        <p class="messages-jeu">
            Taille : <span id="valeurPyramide">3</span> lignes
        </p>

        <div class="preview-pyramide" id="previewPyramide"></div>

    </form>

</div>
<?php endif; ?>

<?php
$content = ob_get_clean();

/* 👇 bouton DANS le footer mais lié au form */
$actions = '
<button type="submit" form="formStart" class="btnGame">
    Jouer
</button>
';

$title = "Welcome - berNimGame";
require "layout.php";
