<?php

echo "-----------Segundo exercício----------- \n";

function fatorial ($i)
{
    $calc = 1;
    while ($i > 1) {
        $calc *= $i;
        $i--;
    }

    return $calc;
}

function meuCount($array)
{
    $i = 0;

    while (true) {
        if ($array[$i]) {
            $i++;
        } else {
            break;
        }
    }
    return $i;
}

$posicoes = array(1, 2, 3, 4, 4, 5);
$posicoes_str = array('a', 'b', 'c', 'd', 'e', 'f');
$c = meuCount($posicoes);
$num_triangulos = fatorial($c) / (fatorial(3) * fatorial($c - 3));

if ($num_triangulos < 1) {
    echo "\nNão é possível formar nenhum triângulo";
    exit;
}

$equilatero = 0;
$isosceles = 0;
$escaleno = 0;

$a = array();
for ($i=0; $i < $c; $i++) {
    for ($j=$i+1; $j < $c; $j++) {
        for ($k=$j+1; $k < $c; $k++) {
            $a[] = $posicoes_str[$i] . " " . $posicoes_str[$j] . " " . $posicoes_str[$k];

            if ($posicoes[$i] == $posicoes[$j] && $posicoes[$j] == $posicoes[$k]) {
                $equilatero++;
            } else if (($posicoes[$i] == $posicoes[$j] || $posicoes[$i] == $posicoes[$k] || $posicoes[$j] == $posicoes[$k])) {
                $isosceles++;
            } else {
                $escaleno++;
            }
        }
    }
}

echo "\nÉ possível formar " . $num_triangulos . " triângulo(s)!\n";
echo "\nN° de triângulos equiláteros: " . $equilatero;
echo "\nN° de triângulos isósceles: " . $isosceles;
echo "\nN° de triângulos escaleno: " . $escaleno;
