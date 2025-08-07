<?php

require_once __DIR__ . '/Titulo.php';

class Serie extends Titulo {
    public function __construct(
        string $nome,
        int $anoLancamento,
        Genero $genero,
        // Os primeiros parâmetros são herdados da classe Titulo.
        public readonly int $numeroDeTemporadas,
        public readonly int $episodiosPorTemporada,
        public readonly int $minutosPorEpisodio,
    ) {
        parent::__construct($nome, $anoLancamento, $genero);
    }
}
