# Conhecendo a Orientação a Objetos
## Definindo um modelo
Implementação da classe `Filme`:
```PHP
// src/Modelos/Filme.php
<?php

class Filme {
    public string $nome;
    public int $anoLancamento;
    public string $genero;
    public float $nota;
}
```
> Note as palavras reservadas `class` (que define uma classe) e `public/private` (que define os níveis de acesso aos atributos da classe).

Adaptação do arquivo `src/funcoes.php`:
```PHP
// src/funcoes.php
// Resto do código 
function criaFilme(string $nome, int $anoLancamento, float $nota, string $genero): Filme
{
    $filme = new Filme();
    $filme->nome = $nome;
    $filme->anoLancamento = $anoLancamento;
    $filme->nota = $nota;
    $filme->genero = $genero;
    return $filme;
}
```
> Note que as propriedades do objeto criado segue o padrão `$obj->propriedade`. **A propriedade não precisa prefixar o cifrão, mas o objeto sim.**


Uso da classe e da função `criaFilme` em `index.php`:
```PHP
// index.php
<?php

require __DIR__ . "/src/funcoes.php";
require __DIR__ . "/src/Modelo/Filme.php";
// Resto do código
echo $filme->anoLancamento;
var_dump($filme->nome);
$posicaoDoisPontos = strpos($filme->nome, ':');
// Resto do código
var_dump(substr($filme->nome, 0, $posicaoDoisPontos));
```
> Novamente: o padrão para acessar as propriedades é: 
> 1. objeto com cifrão prefixado;
> 2. uma seta (operador de acesso à propriedade); e 
> 3. a propriedade (sem prefixo de cifrão).
