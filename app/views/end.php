<?php ob_start(); ?>

<div class="messages-welcome end-welcome">
    <p class="berNimGame">the berNimGame</p>
    <h2 class="winner">
        <?= ($winner === "joueur1") ? "Tu as gagné !" : "On dirait que j'ai gagné, revanche ?" ?>
    </h2>
</div>

<div class="formContainer end-actions">

    <?php if ($winner === "joueur1"): ?>
        <canvas id="confettiCanvas"></canvas>
    <?php endif; ?>

        <form method="post" action="?action=reset">
        <button type="submit" class="btnGame"=>Rejouer</button>
    </form>

    <a href="?action=cv" class="btn">Me contacter</a>
<a href="cv.pdf" target="_blank" class="btn">Ouvrir en plein écran</a>
<a href="cv.pdf" download class="btn">Télécharger</a>


</div>

<div id="victory-flag" data-winner="<?= $winner ?>"></div>

<?php
$content = ob_get_clean();
$title = "Fin de partie - berNimGame";
require "layout.php";
