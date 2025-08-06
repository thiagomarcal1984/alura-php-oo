<?php

class Filme {
    public string $nome;
    public int $anoLancamento;
    public string $genero;
    public float $media;
    public array $notas = [];

    function avalia(float $nota): void {
        if ($nota < 0 || $nota > 10) {
            echo "Nota inválida\n";
            return;
        }
        $this->notas[] = $nota;
    }

    function media(): float {
        if (count($this->notas) === 0) {
            return 0;
        }
        $soma = array_sum($this->notas);
        return $soma / count($this->notas);
    }   
}
