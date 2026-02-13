<?php

class Router {
    public function handleRequest() {
        $action = $_GET['action'] ?? 'home';

        switch ($action) {

            case 'start':
                require "../app/controllers/GameController.php";
                (new GameController())->start();
                break;

            case 'play':
                require "../app/controllers/GameController.php";
                (new GameController())->play();
                break;

            case 'ia':
                require "../app/controllers/GameController.php";
                (new GameController())->ia();
                break;

            case 'reset':
                require "../app/controllers/GameController.php";
                (new GameController())->reset();
                break;

            case 'end':
                require "../app/controllers/GameController.php";
                (new GameController())->end();
                break;

            case 'cv':
                require "../app/controllers/GameController.php";
                (new GameController())->cv();
                break;

            default:
    require "../app/controllers/GameController.php";
    (new GameController())->home();

        }
    }
}
