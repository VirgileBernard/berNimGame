<?php

class GameController {

    public function start() {
        session_start();

        // Mode forcé : toujours contre l'ordinateur
        $mode = "ordi";
        $nbLignes = isset($_POST['nbLignes']) ? (int)$_POST['nbLignes'] : null;

        if (!$nbLignes) {
            $_SESSION['messages'][] = ['text' => "Formulaire incomplet", 'class' => 'error'];
            header("Location: ?action=home");
            exit;
        }

        $_SESSION['mode'] = "ordi";

        // Génération de la pyramide
        $pyramide = [];
        for ($i = 1; $i <= $nbLignes; $i++) {
            $pyramide[] = rand(1, 7);
        }
        $_SESSION['pyramide'] = $pyramide;

        // Tirage du premier joueur
        $_SESSION['tour'] = rand(0,1) ? "joueur1" : "ordi";

        $_SESSION['messages'][] = ['text' => "Pyramide créée.", 'class' => 'setting'];

        // Si l'IA commence, on la laisse jouer
        if ($_SESSION['tour'] === "ordi") {
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

        require "../app/views/game.php";
    }


    public function play() {
        session_start();

        $ligne = (int)$_POST['ligne'];
        $choix = (int)$_POST['choix'];

        $pyramide = $_SESSION['pyramide'];
        $tour = $_SESSION['tour'];

        // Vérification du coup
        if ($choix < 1 || $choix > $pyramide[$ligne]) {
            $_SESSION['messages'][] = ['text' => "Coup invalide.", 'class' => 'error'];
            return $this->renderGame();
        }

        // Application du coup
        $pyramide[$ligne] -= $choix;
        $_SESSION['pyramide'] = $pyramide;

        $_SESSION['messages'][] = [
            'text' => "Tu retires $choix bâton(s) de la ligne " . ($ligne + 1),
            'class' => 'joueur1'
        ];

        // Fin de partie ?
        if (array_sum($pyramide) === 0) {
            $_SESSION['game_over'] = true;
            $_SESSION['winner'] = "joueur1";
            header("Location: ?action=end");
            exit;

        }

        // Tour de l'ordinateur
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
            $_SESSION['mode'] = "ordi";
            $_SESSION['game_over'] = false;
        }
    }


    public function home() {
        session_start();
        $this->initSession();

        $messages = $_SESSION['messages'] ?? [];
        $pyramide = $_SESSION['pyramide'] ?? null;
        $tour = $_SESSION['tour'] ?? null;
        $mode = $_SESSION['mode'] ?? null;
        $game_over = $_SESSION['game_over'] ?? false;

        require "../app/views/home.php";
    }


public function end() {
    session_start();

    $messages = $_SESSION['messages'] ?? [];
    $winner   = $_SESSION['winner'] ?? null;

    require "../app/views/end.php";
}



    public function reset() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ?action=home");
        exit;
    }


    public function ia() {
    session_start();

    $p = $_SESSION['pyramide'];

    // Calcul du coup optimal
    require_once "../app/models/IA.php";
    [$ligne, $choix] = IA::coup($p);

    // Application du coup
    $p[$ligne] -= $choix;
    $_SESSION['pyramide'] = $p;

    $_SESSION['messages'][] = [
        'text' => "Je retire $choix bâton(s) de la ligne " . ($ligne + 1),
        'class' => 'ordi'
    ];

    // Fin de partie ?
    if (array_sum($p) === 0) {
        $_SESSION['game_over'] = true;
        $_SESSION['winner'] = "ordi";
        header("Location: ?action=end");
        exit;

    }

    // Retour au joueur
    $_SESSION['tour'] = "joueur1";
    return $this->renderGame();
}


    public function cv(){
        require "../app/views/cv.php";
    }
}
