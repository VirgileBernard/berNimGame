<?php ob_start(); ?>


<div class="formContainer end-actions">

    <?php if ($winner === "joueur1"): ?>
        <canvas id="confettiCanvas"></canvas>
    <?php endif; ?>

</div>

<aside id="modal1" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
    <div class="modal-wrapper js-modal-stop">
        <!-- <button class="js-modal-close"><i class="fa-solid fa-x"></i></button> -->
        <!-- <h1 id="titlemodal">Mon CV</h1> -->
        <img src="../public/cv.png" alt="monCV" class="cv">
    </div>
</aside>

<div id="victory-flag" data-winner="<?= $winner ?>"></div>

<?php

$actions = '
<button type="button" class="btnGame js-modal" data-target="#modal1">
    Qui suis-je?
</button>

<form method="post" action="?action=reset">
    <button type="submit" class="btnGame">
        Rejouer
    </button>
</form>
';



$content = ob_get_clean();
$title = "Fin de partie - berNimGame";
require "layout.php";
