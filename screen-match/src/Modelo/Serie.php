<?php

class Serie extends Titulo {
    public function __construct(
        public readonly int $numeroDeTemporadas,
        public readonly int $episodiosPorTemporada,
        public readonly int $minutosPorEpisodio,
    ) {
    }
}
