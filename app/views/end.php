<?php ob_start(); ?>

<div class="messages-welcome end-welcome">
    <h2 class="winner">
        <?= ($winner === "joueur1") ? "Félicitations, tu m'as battu !" : "On dirait que j'ai gagné, revanche ?" ?>
    </h2>
</div>

<div class="formContainer end-actions">

    <?php if ($winner === "joueur1"): ?>
        <canvas id="confettiCanvas"></canvas>
    <?php endif; ?>

    <a href="https://virgile-bernard.dev" class="btn-cv" target="_blank">
        Voir mon CV
    </a>

    <form method="post" action="?action=reset">
    <button type="submit">Quitter la partie</button>
</form>

</div>

<div id="victory-flag" data-winner="<?= $winner ?>"></div>


<?php
$content = ob_get_clean();
$title = "Fin de partie - berNimGame";
require "layout.php";
