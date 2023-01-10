<?php

echo "-----------Primeiro exercício----------- \n";

$primeiro_quadrado = array(
    array(2, 1),
    array(4, 1),
    array(2, 4),
    array(4, 4),
);
$segundo_quadrado = array(
    array(1, 1),
    array(1, 5),
    array(5, 5),
    array(5, 1),
);

function separarDoisVerticesVerticaisEHorizontais($quadrado) {
    $vertices_horizontais = array();
    $vertices_verticais = array();

    if ($quadrado[0][0] == $quadrado[1][0]) {
        $vertices_verticais[] = $quadrado[0];
        $vertices_verticais[] = $quadrado[1];

        $vertices_horizontais[] = $quadrado[0];
        $vertices_horizontais[] = $quadrado[3];
    } else if ($quadrado[0][0] == $quadrado[2][0]) {
        $vertices_verticais[] = $quadrado[0];
        $vertices_verticais[] = $quadrado[2];

        $vertices_horizontais[] = $quadrado[0];
        $vertices_horizontais[] = $quadrado[3];
    } else {
        $vertices_verticais[] = $quadrado[0];
        $vertices_verticais[] = $quadrado[4];

        $vertices_horizontais[] = $quadrado[0];
        $vertices_horizontais[] = $quadrado[2];
    }

    return array('vertices_horizontais' => $vertices_horizontais, 'vertices_verticais' => $vertices_verticais);
}

function calcularArea($vertices_horizontais, $vertices_verticais) {
    $base = $vertices_horizontais[0][0] - $vertices_horizontais[1][0];
    $altura = $vertices_verticais[0][1] - $vertices_verticais[1][1];

    return ($base < 0 ? $base * -1 : $base) * ($altura < 0 ? $altura * -1 : $altura);
}

function meuCount($array) {
    $i = 0;

    while(true) {
        if ($array[$i]) {
            $i++;
        } else {
            break;
        }
    }
    return $i;
}

function verificaSobreposicao($quadrado, $vertices) {
    $esta_dentro = array();

    foreach ($quadrado as $sq) {
        if (($vertices['vertices_horizontais'][0][0] <= $sq[0] && $vertices['vertices_horizontais'][1][0] >= $sq[0]) || ($vertices['vertices_horizontais'][1][0] <= $sq[0] && $vertices['vertices_horizontais'][0][0] >= $sq[0])) {
            if (($vertices['vertices_verticais'][0][1] <= $sq[1] && $vertices['vertices_verticais'][1][1] >= $sq[1]) || ($vertices['vertices_verticais'][1][1] <= $sq[1] && $vertices['vertices_verticais'][0][1] >= $sq[1])) {
                $esta_dentro[] = $sq;
            }
        }
    }
    return $esta_dentro;
}

$resultado = separarDoisVerticesVerticaisEHorizontais($primeiro_quadrado);
$primeiro_quadrado_area = calcularArea($resultado['vertices_horizontais'], $resultado['vertices_verticais']);

$resultado_2 = separarDoisVerticesVerticaisEHorizontais($segundo_quadrado);
$segundo_quadrado_area = calcularArea($resultado_2['vertices_horizontais'], $resultado_2['vertices_verticais']);

$vertices_dentro = verificaSobreposicao($segundo_quadrado_area > $primeiro_quadrado_area ? $primeiro_quadrado : $segundo_quadrado, $segundo_quadrado_area > $primeiro_quadrado_area ? $resultado : $resultado_2);

$c = meuCount($vertices_dentro);
if ($c == 0) {
    echo "Um quadrado não sobrepõe o outro!";
    echo "Área do primeiro quadrado: " . $primeiro_quadrado_area . "\n";
    echo "Área do segundo quadrado: " . $segundo_quadrado_area . "\n";
    echo "Área total: 0";
    exit;
} else if ($c == 4) {

    echo "\nOs quadrados se sobrepõem, porém a área total é apenas do quadrado maior já que um está dentro do outro!\n";
    echo "Área do primeiro quadrado: " . $primeiro_quadrado_area . "\n";
    echo "Área do segundo quadrado: " . $segundo_quadrado_area . "\n";
    echo "Área total: " . ($primeiro_quadrado_area > $segundo_quadrado_area ? $primeiro_quadrado_area : $segundo_quadrado_area);
} else {

    echo "\nOs quadrados se sobrepõem!\n";
    echo "Área do primeiro quadrado: " . $primeiro_quadrado_area . "\n";
    echo "Área do segundo quadrado: " . $segundo_quadrado_area . "\n";
    echo "Área total: desconhecido";
}

