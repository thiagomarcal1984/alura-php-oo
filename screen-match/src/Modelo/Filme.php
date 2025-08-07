<?php

require_once __DIR__ . '/Titulo.php';

class Filme extends Titulo {
    public function __construct(
        string $nome,
        int $anoLancamento,
        Genero $genero,
        // Os primeiros parâmetros são herdados da classe Titulo.
        public readonly int $duracaoEmMinutos,
    ) {
        parent::__construct($nome, $anoLancamento, $genero);
    }
}
