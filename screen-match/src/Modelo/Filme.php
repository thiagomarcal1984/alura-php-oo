<?php

class Filme {
    private array $notas;

    public function __construct(
        private string $nome = 'Nome padrão', 
        private int $anoLancamento = 2024, 
        private string $genero = 'ação'
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

    public function anoLancamento(): int {
        return $this->anoLancamento;
    }

    public function nome(): string {
        return $this->nome;
    }

    public function genero(): string {
        return $this->genero;
    }
}
