<?php

require __DIR__ . '/src/Modelo/Filme.php';
require __DIR__ . '/src/Modelo/Genero.php';
require __DIR__ . '/src/Modelo/Serie.php';
require __DIR__ . '/src/Calculos/CalculadoraDeMaratona.php';

echo "Bem-vindo(a) ao Screen Match!\n";

$filme = new Filme(
    "Thor: Ragnarok", 
    2021, 
    Genero::SUPERHEROI,
    180,
);
$filme->avalia(10);
$filme->avalia(10);
$filme->avalia(5);
$filme->avalia(5);

var_dump($filme);

echo $filme->media() . "\n";
echo $filme->anoLancamento . "\n";
echo $filme->genero->descricao() . "\n";

$serie = new Serie(
    "Lost",
    2007,
    Genero::DRAMA,
    10,
    20,
    30
);

echo $serie->anoLancamento . "\n";
$serie->avalia(8);
echo $serie->media() . "\n";

$calculadora = new CalculadoraDeMaratona();
$calculadora->inclui($filme);
$calculadora->inclui($serie);
echo "Duração total da maratona: " . $calculadora->duracaoEmMinutos() . " minutos\n";
