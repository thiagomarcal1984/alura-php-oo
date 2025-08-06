<?php

class Filme {
    private string $nome;
    private int $anoLancamento;
    private string $genero;
    private float $media;
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
}
