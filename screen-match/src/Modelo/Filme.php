<?php

class Filme {
    private string $nome = 'Nome padrão';
    private int $anoLancamento = 2024;
    private string $genero = 'ação';
    private array $notas = [];

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
    public function defineAnoLancamento(int $anoLancamento): void {
        $this->anoLancamento = $anoLancamento;
    }
}
