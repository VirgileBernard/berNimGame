<?php

class IA {

    public static function estPositionGagnante(array $p) {
        static $memo = [];

        $key = implode(',', $p);

        if (isset($memo[$key])) return $memo[$key];
        if (array_sum($p) === 0) return $memo[$key] = false;

        foreach ($p as $i => $pile) {
            for ($r = 1; $r <= $pile; $r++) {
                $new = $p;
                $new[$i] -= $r;

                if (!self::estPositionGagnante($new)) {
                    return $memo[$key] = true;
                }
            }
        }

        return $memo[$key] = false;
    }


    public static function coup(array $p): array {

        // 1. Chercher un coup gagnant
        foreach ($p as $i => $pile) {
            for ($r = 1; $r <= $pile; $r++) {
                $new = $p;
                $new[$i] -= $r;

                if (!self::estPositionGagnante($new)) {
                    return [$i, $r];
                }
            }
        }

        // 2. Sinon coup aléatoire
        $lignesNonVides = array_keys(array_filter($p));
        $ligne = $lignesNonVides[array_rand($lignesNonVides)];
        return [$ligne, 1];
    }
}
