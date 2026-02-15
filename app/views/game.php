<?php ob_start(); ?>

<div class="messages-welcome">
        <p class="berNimGame">the berNimGame</p>
</div>

<!-- message d'info de ce qui vient de se passer  -->

<div class="messages-jeu">
    <?php foreach ($messages as $msg): ?>
        <?php if ($msg['class'] !== 'setting'): ?>
            <p class="message <?= $msg['class'] ?>">
                <?= htmlspecialchars($msg['text']) ?>
            </p>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<div class="formContainer">
    <?php if (!$game_over): ?>
    <p class="tour-actuel <?= $tour ?>">
        <?= ($tour === "joueur1") ? "C'est ton tour !" : "C'est mon tour !" ?>
    </p>
<?php endif; ?>

<div class="pyramide">
    <?php foreach ($pyramide as $i => $nb): ?>
        <div class="ligne">
            <?php for ($b = 0; $b < $nb; $b++): ?>
                <span class="baton" data-ligne="<?= $i ?>" data-index="<?= $b ?>"></span>
            <?php endfor; ?>
        </div>
    <?php endforeach; ?>
</div>

<form method="post" action="?action=reset">
    <button type="submit" class="btnGame">Quitter la partie</button>
</form>
</div>

<?php if ($mode === "ordi" && $tour === "ordi" && !$game_over): ?>

    <!-- Formulaire IA -->
    <form id="tourIA" method="post" action="?action=ia">
        <input type="hidden" name="ia" value="1">
    </form>

    <?php
    // Script spécifique pour déclencher l'IA
    $pageScript = <<<JS
setTimeout(() => {
    const formIA = document.getElementById("tourIA");
    if (formIA) formIA.submit();
}, 1200);
JS;
    ?>

<?php endif; ?>

<?php
$content = ob_get_clean();
$title = "Partie en cours - berNimGame";
require "layout.php";
