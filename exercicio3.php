<?php

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


$ligacoes = array(
    'A-B',
    'B-C',
    'C-E',
    'B-E',
    'B-D',
    'A-D',
    'D-F',
    'D-E',
    'E-F',
    'E-G',
    'F-G'
);

function montar_caminho($ligacoes, $destino = 'G', $letra = 'A') {
    $caminhos = array();
    for ($i = 0; $i < meuCount($ligacoes); $i++) {

        if ($ligacoes[$i][0] == $letra) {

            if ($ligacoes[$i][2] == $destino) {
                $caminhos[] = array(
                    'antes' => $ligacoes[$i][0],
                    'depois' => $ligacoes[$i][2],
                );
            } else {
                $caminhos[] = array(
                    'antes' => $ligacoes[$i][0],
                    'depois' => montar_caminho($ligacoes, $destino, $ligacoes[$i][2])
                );
            }
        }
    }
    return $caminhos;
}

function montar_array($ligacoes, $destino = 'G', $letra = 'A') {
    $todos_caminhos = array();

    for ($i = 0; $i < meuCount($ligacoes); $i++) {

        if ($ligacoes[$i][0] == $letra) {

            if ($ligacoes[$i][2] == $destino) {
                $todos_caminhos[] = array(
                    'antes' => $ligacoes[$i][0],
                    'depois' => $ligacoes[$i][2],
                );
            } else {
                $todos_caminhos[] = array(
                    'antes' => $ligacoes[$i][0],
                    'depois' =>  montar_caminho($ligacoes, $destino, $ligacoes[$i][2])
                );
            }
        }
    }

    return $todos_caminhos;
}

$todos_caminhos = montar_array($ligacoes);
print_r($todos_caminhos);

## Para ler o print, primeiro ler todas colunas "antes" para depois ler a "depois"
## Ex: antes, antes, antes, antes, depois
## Ex: antes, antes, antes, depois, depois
## Formara os caminhos possíveis
