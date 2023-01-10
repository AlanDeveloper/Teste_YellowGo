<?php

echo "-----------Primeiro exercício----------- \n";
echo "\nInforme as posições do retângulo separado por espaços(ex: X Y)\n";

$primeiro_quadrado = array();
$ponto = null;
for ($i=0; $i < 4; $i++) {
    if ($ponto == "" && !is_null($ponto)) {
        $i--;
    } else {
        $ponto = readline("Informe a posição: ");
        array_push($primeiro_quadrado, explode(' ', $ponto));
    }
}

$segundo_quadrado = array();
$ponto = null;
for ($i = 0; $i < 4; $i++) {
    if ($ponto == "" && !is_null($ponto)) {
        $i--;
    } else {
        $ponto = readline("Informe a posição: ");
        array_push($segundo_quadrado, explode(' ', $ponto));
    }
}

$area = null;
$x = null;
$y = null;
foreach ($primeiro_quadrado as $pq) {
    if (is_null($x) || is_null($y)) {
        $x = $pq[0];
        $y = $pq[1];
    } else {
        if ($x == $pq[0]) {
            if (!is_null($area)) {
                $area = $area * ($y < $pq[1] ? $pq[1] - $y : $y - $pq[1]);
            } else {
                $area = $y < $pq[1] ? $pq[1] - $y : $y - $pq[1];
            }
        }
        if ($y == $pq[1]) {
            if (!is_null($area)) {
                $area = $area * ($x < $pq[0] ? $pq[0] - $x : $x - $pq[0]);
            } else {
                $area = $x < $pq[0] ? $pq[0] - $x : $x - $pq[0];
            }
        }
    }
}

print_r($primeiro_quadrado);
