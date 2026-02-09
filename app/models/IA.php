<?php

class IA{

    public static function estPositionGagnante(array $p){
    static $memo = [];
    $key = implode(',' $pyramide);

    if(isset($memo[$key])) return $memo[$key];
    if (array_sum($pyramide) === 0) return $memo[$key] = false;

    foreach($pyramide as $i => $pile){
        for($r = 1; $r<=$pile; $r++){
            $new = $pyramide;
            $new[$i] -= $r;
            if(!estPositionGagnante($new)) return $memo[$key]=true;
        }
    }
    return $memo[$key]=false;
    }

    public static function coup(array $p): array{
    $p = $_SESSION['pyramide'];

    foreach($p as $i => $pile){
        for($r = 1; $r <= $pile; $r++){
            $new = $p;
            $new[$i] -= $r;
            if(!estPositionGagnante($new)) return [$i, $r];
        }
    }

    $lignesNonVides = array_keys(array_filter($p));
    $ligne = $lignesNonVides[array_rand($lignesNonVides)];
    return [$ligne, 1];
    }
}