<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>BernimGame</title>
</head>
<body>


<div class="themeToggle">
    <button id="themeToggleBtn" class="toggle-btn">
        <i class="fa-solid fa-moon"></i>
    </button>
</div>


<!-- Messages -->
<div class="messages-jeu">
    <?php foreach ($messages as $msg): ?>
        <?php if ($msg['class'] !== 'setting'): ?>
            <p class="message <?= $msg['class'] ?>">
                <?= htmlspecialchars($msg['text']) ?>
            </p>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<!-- Tour actuel -->
<?php if (!$game_over): ?>
    <p class="tour-actuel <?= $tour ?>">
        <?php
       echo ($tour === "joueur1") ? "C'est ton tour !" : "C'est mon tour !";

        ?>
    </p>
<?php endif; ?>

<!-- Pyramide -->
<div class="pyramide">
    <?php foreach ($pyramide as $i => $nb): ?>
        <div class="ligne">
            <?php for ($b = 0; $b < $nb; $b++): ?>
                <span class="baton" data-ligne="<?= $i ?>" data-index="<?= $b ?>"></span>
            <?php endfor; ?>
        </div>
    <?php endforeach; ?>
</div>

<!-- Bouton reset -->
<form method="post" action="?action=reset">
    <button type="submit">Quitter la partie</button>
</form>

<!-- IA : latence + formulaire caché -->
<?php if ($mode === "ordi" && $tour === "ordi" && !$game_over): ?>
    <script>
        setTimeout(() => {
            document.getElementById("tourIA").submit();
        }, 1200);
    </script>

    <form id="tourIA" method="post" action="?action=ia">
        <input type="hidden" name="ia" value="1">
    </form>
<?php endif; ?>

<script src="../public/script.js"></script>

</body>
</html>
