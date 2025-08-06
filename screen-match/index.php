<?php

require __DIR__ . '/src/Modelo/Filme.php';

echo "Bem-vindo(a) ao Screen Match!\n";

$filme = new Filme();
// $filme->nome = "Thor: Ragnarok";
$filme->defineAnoLancamento(2021);
// $filme->genero = "super-herói";
$filme->avalia(10);
$filme->avalia(10);
$filme->avalia(5);
$filme->avalia(5);

var_dump($filme);

echo $filme->media() . "\n";
echo $filme->anoLancamento() . "\n";
