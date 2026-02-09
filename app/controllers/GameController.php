<?php

class GameController{

public function start() {
    session_start();

    $mode = $_POST['mode'] ?? null;
    $nbLignes = isset($_POST['nbLignes']) ? (int)$_POST['nbLignes'] : null;

    if (!$mode || !$nbLignes) {
        $_SESSION['messages'][] = ['text' => "Formulaire incomplet", 'class' => 'error'];
        header("Location: ?action=home");
        exit;
    }

    $_SESSION['mode'] = $mode;

    $pyramide = [];
    for ($i = 1; $i <= $nbLignes; $i++) {
        $pyramide[] = rand(1, 7);
    }
    $_SESSION['pyramide'] = $pyramide;

    $_SESSION['tour'] = rand(0,1) ? "joueur1" : ($mode === "ordi" ? "ordi" : "joueur2");

    $_SESSION['messages'][] = ['text' => "Pyramide créée.", 'class' => 'setting'];

    if ($mode === "ordi" && $_SESSION['tour'] === "ordi") {
        header("Location: ?action=ia");
        exit;
    }

    $this->renderGame();
}


private function renderGame() {
    $messages  = $_SESSION['messages'];
    $pyramide  = $_SESSION['pyramide'];
    $tour      = $_SESSION['tour'];
    $mode      = $_SESSION['mode'];
    $game_over = $_SESSION['game_over'] ?? false;
    var_dump($pyramide);


    
    require "../app/views/game.php";
}


public function play() {
    session_start();

    // Récupération des données du formulaire
    $ligne = (int)$_POST['ligne'];
    $choix = (int)$_POST['choix'];

    // Récupération de l'état du jeu
    $pyramide = $_SESSION['pyramide'];
    $tour = $_SESSION['tour'];
    $mode = $_SESSION['mode'];

    // Vérification du coup
    if ($choix < 1 || $choix > $pyramide[$ligne]) {
        $_SESSION['messages'][] = ['text' => "Coup invalide.", 'class' => 'error'];
        return $this->renderGame();
    }

    // Application du coup
    $pyramide[$ligne] -= $choix;
    $_SESSION['pyramide'] = $pyramide;

    $_SESSION['messages'][] = [
        'text' => "$tour retire $choix bâton(s) de la ligne " . ($ligne + 1),
        'class' => $tour
    ];

    // Vérification fin de partie
    if (array_sum($pyramide) === 0) {
        $_SESSION['game_over'] = true;
        $_SESSION['winner'] = ($mode === "ordi") ? "joueur1" : $tour;
        return $this->renderEnd();
    }

    // Changement de tour
    if ($mode === "joueur") {
        $_SESSION['tour'] = ($tour === "joueur1") ? "joueur2" : "joueur1";
        return $this->renderGame();
    }

    // Mode joueur vs IA → l’IA joue ensuite
    $_SESSION['tour'] = "ordi";
    return $this->renderGame();
}

private function initSession() {
    if (!isset($_SESSION['initialized'])) {
        $_SESSION['initialized'] = true;

        $_SESSION['messages'] = [
            ['text' => "Bienvenue dans le berNimGame !", 'class' => 'setting']
        ];

        $_SESSION['tour'] = "joueur1";
        $_SESSION['mode'] = null;
        $_SESSION['game_over'] = false;
    }
}





public function home(){
    session_start();
    $this->initSession();

    $messages = $_SESSION['messages'] ?? [];
    $pyramide = $_SESSION['pyramide'] ?? null;
    $tour = $_SESSION['tour'] ?? null;
    $mode = $_SESSION['mode'] ?? null;
    $game_over = $_SESSION['game_over'] ?? false;
    
    require "../app/views/home.php";
}


}