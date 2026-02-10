<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <title>Fin de partie</title>
</head>
<body>

<h1>berNimGame</h1>

<div class="themeToggle">
    <button id="themeToggleBtn" class="toggle-btn">
        <i class="fa-solid fa-moon"></i>
    </button>
</div>

<div class="end-container">

    <h2 class="winner">
        <?= ($winner === "joueur1") ? "Vous avez gagné 🎉" : "L'ordinateur a gagné 🤖" ?>
    </h2>

    <div class="messages-end">
        <?php foreach ($messages as $msg): ?>
            <p class="message <?= $msg['class'] ?>">
                <?= htmlspecialchars($msg['text']) ?>
            </p>
        <?php endforeach; ?>
    </div>

    <form method="post" action="?action=reset">
        <button type="submit" class="btn-restart">Rejouer</button>
    </form>

</div>

<script src="../public/script.js"></script>

</body>
</html>
