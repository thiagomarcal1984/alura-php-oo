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

## Valor vs Referência
O comando `php -a` serve para acessar o console interativo do PHP.

Execute o comando no diretório `screen-match` (a raiz do projeto PHP).

```bash
php > require 'src/Modelo/Filme.php';
php > $filme = new Filme();
php > $filme->nome = 'Nome do filme';
php > var_dump($filme);
object(Filme)#1 (1) {
  ["nome"]=>
  string(13) "Nome do filme"
  ["anoLancamento"]=>
  uninitialized(int)
  ["genero"]=>
  uninitialized(string)
  ["nota"]=>
  uninitialized(float)
}
php >
```
> Valor vs: Referência: 
> 1. variáveis de tipos primitivos, quando são atribuídas a outras variáveis, COPIAM o valor na atribuição; 
> 2. variáveis de tipo object, quando são atribuídas a outras variáveis, REFERENCIAM o objeto atribuído.

# Controlando o acesso
## Definindo ações para o filme
Mudança na implementação da classe `Filme`:
```PHP
// src/Modelo/Filme.php
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
```
> Note que dentro das functions `avalia` e `media` as referências aos atributos do objeto instanciado são prefixadas com a palavra reservada `$this`. Sem ela, o PHP interpreta que o atributo na verdade é uma variável de bloco da função.

O antigo arquivo `index.php` foi copiado para o arquivo `antigo.php`.

O novo código de `index.php` é o seguinte: 
```PHP
// index.php
<?php

require __DIR__ . '/src/Modelo/Filme.php';

echo "Bem-vindo(a) ao Screen Match!\n";

$filme = new Filme();
$filme->nome = "Thor: Ragnarok";
$filme->anoLancamento = 2021;
$filme->genero = "super-herói";
$filme->avalia(10);
$filme->avalia(6);
$filme->avalia(7.8);
$filme->avalia(8.2);

var_dump($filme->notas);

echo $filme->media() . "\n";
```
