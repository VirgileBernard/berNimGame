<?php ob_start(); ?>

<div class="messages-welcome">
    <p class="welcome">Welcome to</p>
    <p class="berNimGame">the berNimGame</p>
</div>


<?php if ($pyramide === null): ?>
<div class="formContainer">
    <form method="post" action="?action=start">
        <p>Choisissez le nombre de lignes</p>
        <input type="range" name="nbLignes" min="3" max="5" step="1" value="3" id="sliderPyramide">

        <p>Taille : <span id="valeurPyramide">3</span> lignes</p>

        <div class="preview-pyramide" id="previewPyramide"></div>

        <button type="submit">Jouer</button>
    </form>
</div>
<?php endif; ?>

<?php
$content = ob_get_clean();
$title = "Welcome - berNimGame";
require "layout.php";
