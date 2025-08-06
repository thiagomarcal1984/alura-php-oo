<?php

require __DIR__ . '/src/Modelo/Filme.php';
require __DIR__ . '/src/Modelo/Genero.php';

echo "Bem-vindo(a) ao Screen Match!\n";

$filme = new Filme(
    "Thor: Ragnarok", 
    2021, 
    Genero::SUPERHEROI
);
$filme->avalia(10);
$filme->avalia(10);
$filme->avalia(5);
$filme->avalia(5);

var_dump($filme);

echo $filme->media() . "\n";
echo $filme->anoLancamento . "\n";
echo $filme->genero->descricao() . "\n";
