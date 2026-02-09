<?php

class Game{
    public array $pyramide = [];
    public string $tour = "joueur1";
    public string $mode = "joueur";
    public bool $gameOver = false;
    public ?string $winner = null;

    public function init(int $nbLignes){
        $this->pyramide=[];
        for($i = 1; $i <= $nbLignes; $i++){
            $this->pyramide[] = rand(1, 7);
        }
    }

    public function retirer(int $ligne, int $nb){
        $this->pyramide[$ligne] -= $nb;
    }

    public function estTerminee(): bool{
        return array_sum($this->pyramide) === 0;
    }

}