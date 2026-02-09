<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/style.css">
    <title>BernimGame – Partie</title>
</head>
<body>

<h1>berNimGame</h1>

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
            if ($mode === "joueur") {
                echo ($tour === "joueur1") ? "Tour de Joueur 1" : "Tour de Joueur 2";
            } else {
                echo ($tour === "joueur1") ? "Votre tour" : "Tour de l'ordinateur";
            }
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

<!-- JS pour les bâtons -->
<script>
document.querySelectorAll(".baton").forEach(baton => {

    baton.addEventListener("mouseenter", () => {
        const ligne = baton.dataset.ligne;
        const index = parseInt(baton.dataset.index);

        document.querySelectorAll(`.baton[data-ligne="${ligne}"]`).forEach(b => {
            if (parseInt(b.dataset.index) <= index) {
                b.classList.add("preview");
            }
        });
    });

    baton.addEventListener("mouseleave", () => {
        document.querySelectorAll(".baton.preview").forEach(b => {
            b.classList.remove("preview");
        });
    });

    baton.addEventListener("click", () => {
        const ligne = baton.dataset.ligne;
        const index = parseInt(baton.dataset.index);

        document.querySelectorAll(`.baton[data-ligne="${ligne}"]`).forEach(b => {
            if (parseInt(b.dataset.index) <= index) {
                b.classList.add("disappear");
            }
        });

        setTimeout(() => {
            const form = document.createElement("form");
            form.method = "post";
            form.action = "?action=play";

            const inputLigne = document.createElement("input");
            inputLigne.type = "hidden";
            inputLigne.name = "ligne";
            inputLigne.value = ligne;

            const inputChoix = document.createElement("input");
            inputChoix.type = "hidden";
            inputChoix.name = "choix";
            inputChoix.value = index + 1;

            form.appendChild(inputLigne);
            form.appendChild(inputChoix);
            document.body.appendChild(form);

            form.submit();
        }, 300);
    });

});
</script>

</body>
</html>
