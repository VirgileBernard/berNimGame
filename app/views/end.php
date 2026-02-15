<?php ob_start(); ?>

<div class="messages-welcome end-welcome">
    <p class="berNimGame">the berNimGame</p>
</div>

<div class="formContainer end-actions">

    <?php if ($winner === "joueur1"): ?>
        <canvas id="confettiCanvas"></canvas>
    <?php endif; ?>

        <form method="post" action="?action=reset">
        <button type="submit" class="btnGame">Rejouer</button>
    </form>

</div>

<a href="#modal1" class="js-modal">Ouvrir mon CV</a>

<aside id="modal1" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
    <div class="modal-wrapper js-modal-stop">
        <button class="js-modal-close">Fermer</button>
        <h1 id="titlemodal">Mon CV</h1>
        <img src="../public/cv.png" alt="monCV">
    </div>
</aside>

<div id="victory-flag" data-winner="<?= $winner ?>"></div>

<?php
$content = ob_get_clean();
$title = "Fin de partie - berNimGame";
require "layout.php";
