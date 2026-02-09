<?php

class GameController{

public function start(){
    session_start();
    $game = new Game();
    $game->init($_POST['nbLignes']);
    $_SESSION['game'] = $game;

    require "../app/views/game.php";
}

public function play(){
    session_start();
    $game = $_SESSION['game'];

    $ligne = (int)$_POST['ligne'];
    $choix = (int)$_POST['choix'];

    $game->retirer($ligne, $choix);

    if($game->estTerminee()){
        $game->gameOver = true;
        $game->winner = "joueur1";
        require "../app/views/end.php";
        return;
    }

    $_SESSION['game'] = $game;
    require "../app/views.game.php";
}

private function initSession() {
    if (!isset($_SESSION['initialized'])) {
        $_SESSION['initialized'] = true;

        $_SESSION['messages'] = [
            ['text' => "Bienvenue dans le berNimGame !",
            'class' => 'setting'
            ]
        ];

        $_SESSION['pyramide'] = null;
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