<?php

echo "-----------Segundo exercício----------- \n";
echo "\nInforme as posições separado por espaços(ex: a b c d e f)\n";

function fatorial ($i)
{
    $calc = 1;
    while ($i > 1) {
        $calc *= $i;
        $i--;
    }

    return $calc;
}

$posicoes = array();
$str = null;
for ($i = 0; $i < 1; $i++) {
    $str = readline("Informe a posição: ");
    if ($str == "") {
        $i--;
        continue;
    }
    $posicoes = explode(' ', $str);
}

$num_triangulos = fatorial(count($posicoes)) / (fatorial(3) * fatorial(count($posicoes) - 3));

if ($num_triangulos < 1) {
    echo "\nNão é possível formar nenhum triângulo";
    exit;
}

echo "\nÉ possível formar " . $num_triangulos . " triângulos!";

$equilatero = array();
$isosceles = array();
$escaleno = array();

$pos1 = null;
$pos2 = null;
$pos3 = null;
while (true) {
    if ((count($equilatero) + count($isosceles) + count($escaleno)) == $num_triangulos) {
        break;
    }

    while ($pos1 == $pos2 || $pos1 == $pos3 || $pos3 == $pos2) {

        $pos1 = rand(0, count($posicoes) - 1);
        $pos2 = rand(0, count($posicoes) - 1);
        $pos3 = rand(0, count($posicoes) - 1);
    }

    if (array_search($posicoes[$pos1] . "" . $posicoes[$pos2] . "" . $posicoes[$pos3], $equilatero) || array_search($posicoes[$pos1] . "" . $posicoes[$pos2] . "" . $posicoes[$pos3], $isosceles) || array_search($posicoes[$pos1] . "" . $posicoes[$pos2] . "" . $posicoes[$pos3], $escaleno)) {
        $pos1 = null;
        $pos2 = null;
        $pos3 = null;

        continue;
    }

    if ($posicoes[$pos1] == $posicoes[$pos2] && $posicoes[$pos1] == $posicoes[$pos3]) {
        array_push($equilatero, $posicoes[$pos1] . "" . $posicoes[$pos2] . "" . $posicoes[$pos3]);
    } else if (($posicoes[$pos1] == $posicoes[$pos2] || $posicoes[$pos1] == $posicoes[$pos3] || $posicoes[$pos2] == $posicoes[$pos3])) {
        array_push($isosceles, $posicoes[$pos1] . "" . $posicoes[$pos2] . "" . $posicoes[$pos3]);
    } else {
        array_push($escaleno, $posicoes[$pos1] . "" . $posicoes[$pos2] . "" . $posicoes[$pos3]);
    }

    $pos1 = null;
    $pos2 = null;
    $pos3 = null;
}

echo "\nN° de triângulos equiláteros: " . count($equilatero);
echo "\nN° de triângulos isósceles: " . count($isosceles);
echo "\nN° de triângulos escaleno: " . count($escaleno);


print_r($equilatero);
print_r($escaleno);
print_r($isosceles);
