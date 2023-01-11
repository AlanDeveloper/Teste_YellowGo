<?php

// EXEMPLO
//     A   B   C   D
// A   -   -   -   -
// B   B   -   -   D
// C   C   C   -   -
// D   D   -   D   -

// Caminhos possíveis A-D: [A, D], [A, C, D], [A, B, D], [A, B, C, D]

$matrix = [
    ['-', '-', '-', '-'],
    ['B', '-', '-', 'D'],
    ['C', 'C', '-', '-'],
    ['D', '-', 'D', '-'],
];
$colunas = array(
    'A' => 0,
    'B' => 1,
    'C' => 2,
    'D' => 3,
);
$destino = 'D';

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
