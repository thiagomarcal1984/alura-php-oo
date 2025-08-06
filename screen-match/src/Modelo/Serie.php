<?php

class Serie {
    private array $notas;

    public function __construct(
        public readonly string $nome,
        public readonly int $anoLancamento,
        public readonly Genero $genero,
        public readonly int $numeroDeTemporadas,
        public readonly int $episodiosPorTemporada,
        public readonly int $minutosPorEpisodio,
    ) {
        $this->notas = [];
    }

    public function avalia(float $nota): void {
        if ($nota < 0 || $nota > 10) {
            echo "Nota inválida\n";
            return;
        }
        $this->notas[] = $nota;
    }

    public function media(): float {
        if (count($this->notas) === 0) {
            return 0;
        }
        $soma = array_sum($this->notas);
        return $soma / count($this->notas);
    }   
}
