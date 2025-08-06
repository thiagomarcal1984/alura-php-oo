<?php

class Filme {
    private array $notas;

    public function __construct(
        public readonly string $nome = 'Nome padrão', 
        public readonly int $anoLancamento = 2024, 
        public readonly Genero $genero = Genero::ACAO
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
