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
## Conhecendo os conceitos
- As variáveis de objetos são chamados de **atributos** ou **propriedades**;
- As funções de objetos PHP são chamados de **métodos**.

## Impedindo acesso aos dados
Vamos usar as palavras reservadas `private` (para todos os atributos) e `public` (para todos os métodos).

A ideia é evitar acesso direto às propriedades e permitir sua modificação somente por meio dos métodos.

```PHP
// src/Modelo/Filme.php
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
```

O código de `index.php` vai quebrar, por causa do uso do modificador `private` em todos os atributos. Na próxima aula vamos criar os métodos públicos que permitem as operações sobre os atributos (todos privados).

## Getters e setters
Vamos criar um getter e um setter para o atributo `anoLancamento` da classe `Filme`:
```PHP
// src/Modelo/Filme.php
<?php

class Filme {
    private int $anoLancamento = 2024;
    // Resto do código

    public function anoLancamento(): int {
        return $this->anoLancamento;
    }
    public function definieAnoLancamento(int $anoLancamento): void {
        $this->anoLancamento = $anoLancamento;
    }
}
```

E na página `index.php` vamos modificar o código para usar o getter e o setter: 
```PHP
// index.php
<?php

require __DIR__ . '/src/Modelo/Filme.php';

$filme = new Filme();
$filme->defineAnoLancamento(2021);
// Resto do código

echo $filme->anoLancamento() . "\n";
```
# Modelo mais robusto
## Método construtor
Para criar um construtor de um objeto, implementamos a função `__construct` dentro da classe desse objeto.

Criando o construtor da classe `Filme` do jeito **antigo**:
```PHP
<?php

class Filme {
    private string $nome;
    private int $anoLancamento;
    private string $genero;
    private array $notas;

    public function __construct(
        string $nome = 'Nome padrão', 
        int $anoLancamento = 2024, 
        string $genero = 'ação'
    ) {
        $this->nome = $nome;
        $this->anoLancamento = $anoLancamento;
        $this->genero = $genero;
        $this->notas = [];
    }
    // Resto do código
}
```

> Métodos construtores no PHP **NÃO PODEM TER RETORNO**!!! O retorno implicitamente é o objeto construído.

Criando o construtor da classe `Filme` do jeito **novo**:
```PHP
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
    // Resto do código
}
```
> Note que os modificadores de acesso `private` ficam **dentro** dos parênteses do construtor. O atributo `$notas` foi criado à parte para que ele não seja requisitado pelo construtor.

## Propriedades para leitura
Se dentro dos parâmetros do construtor usarmos o modificador de acesso `public readonly`, os atributos declarados permitem escrita apenas na construção e leitura sem precisar criar os getters! Os atributos serão diretamente acessíveis para leitura apenas (readonly).

```PHP
// src/Modelo/Filme.php
<?php

class Filme {
    private array $notas;

    public function __construct(
        public readonly string $nome = 'Nome padrão', 
        public readonly int $anoLancamento = 2024, 
        public readonly string $genero = 'ação'
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
```
> Veja como a classe ficou mais limpa! Os métodos não replicam o boilerplate de getters e setters dos atributos!
> 
> É possível declarar a classe inteira como `readonly`. A desvantagem é que nada no objeto pode ser alterado depois que ele for construído.
> ```PHP
> <?php
> readonly class Classe {
>   //Resto do código    
> }
> ```

Nova implementação de `index.php`:
```PHP
// index.php
<?php

require __DIR__ . '/src/Modelo/Filme.php';

echo "Bem-vindo(a) ao Screen Match!\n";

$filme = new Filme(
    "Thor: Ragnarok", 
    2021, 
    "super-herói"
);
// Resto do código
echo $filme->anoLancamento . "\n"; // Note que não há chamada a método!
```
## Definindo um tipo para gênero
Criando a enumeração `Genero`:
```PHP
// src/Modelo/Genero
<?php

enum Genero {
    case ACAO;
    case COMEDIA;
    case DRAMA;
    case TERROR;
    case SUPERHEROI;

    public function descricao(): string {
        return match($this) {
            self::ACAO => 'Ação',
            self::COMEDIA => 'Comédia',
            self::DRAMA => 'Drama',
            self::TERROR => 'Terror',
            self::SUPERHEROI => 'Super-herói',
            default => 'Gênero desconhecido',
        };
    }
}
```
Modificando a classe `Filme` para conter o objeto do tipo `Genero`:
```PHP
// src/Modelo/Genero.php
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
    // Resto do código
}
```

Uso das classes em `index.php`:
```PHP
// index.php
<?php

require __DIR__ . '/src/Modelo/Filme.php';
require __DIR__ . '/src/Modelo/Genero.php';

echo "Bem-vindo(a) ao Screen Match!\n";

$filme = new Filme(
    "Thor: Ragnarok", 
    2021, 
    Genero::SUPERHEROI
);
// Resto do código
echo $filme->genero->descricao() . "\n";
```
# Séries no ScreenMatch
## Modelando uma série
Implementação da nova classe `Serie`:
```PHP
// src/Modelo/Serie.php
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
```
> Algumas modificações foram feitas na classe `Filme` e na `index.php`, mas não são relevantes no momento.

Na próxima aula vamos aprender a extrair o conteúdo comum entre as classes `Filme` e `Serie`.

## Extraindo o que é comum
Vamos criar uma superclasse chamada `Titulo`:

```PHP
// src/Modelo/Titulo.php
<?php

class Titulo {
    private array $notas;

    public function __construct(
        public readonly string $nome,
        public readonly int $anoLancamento,
        public readonly Genero $genero,
    ) {
        $this->notas = [];
    }

    public function avalia(float $nota): void {
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
```

E vamos modificar as classes `Filme` e `Serie` para extenderem `Titulo` e enxugar os excessos/repetições:
```PHP
// src/Modelo/Filme.php
<?php

class Filme extends Titulo {
    public function __construct(
        public readonly int $duracaoEmMinutos,
    ) {
    }
}

// src/Modelo/Filme.php
<?php

class Serie extends Titulo {
    public function __construct(
        public readonly int $numeroDeTemporadas,
        public readonly int $episodiosPorTemporada,
        public readonly int $minutosPorEpisodio,
    ) {
    }
}
```

O código, porém ainda não está funcional na `index.php`. Na próxima aula vamos resolver o problema.
```
PHP Fatal error:  Uncaught TypeError: Filme::__construct(): Argument #1 ($duracaoEmMinutos) must be of type int, string given, called in D:\alura\php-oo\screen-match\index.php on line 13 and defined in D:\alura\php-oo\screen-match\src\Modelo\Filme.php:4
Stack trace:
#0 D:\alura\php-oo\screen-match\index.php(13): Filme->__construct('Thor: Ragnarok', 2021, Object(Genero), 180)
#1 {main}
  thrown in D:\alura\php-oo\screen-match\src\Modelo\Filme.php on line 4

Fatal error: Uncaught TypeError: Filme::__construct(): Argument #1 ($duracaoEmMinutos) must be of type int, string given, called in D:\alura\php-oo\screen-match\index.php on line 13 and defined in D:\alura\php-oo\screen-match\src\Modelo\Filme.php:4
Stack trace:
#0 D:\alura\php-oo\screen-match\index.php(13): Filme->__construct('Thor: Ragnarok', 2021, Object(Genero), 180)
#1 {main}
  thrown in D:\alura\php-oo\screen-match\src\Modelo\Filme.php on line 4
```
## Especializando as classes
É necessário incluir os parâmetros da superclasse nas subclasses, e invocar o construtor da superclasse em cada superclasse.

A invocação do construtor da superclasse é feito por meio do código `parent::__construct($parametros)`. Os parâmetros da superclasse não precisam dos modificadores de acesso.

Veja a implementação das subclasses:
```PHP
// src/Modelo/Filme.php
<?php

require_once __DIR__ . '/Titulo.php';

class Filme extends Titulo {
    public function __construct(
        string $nome,
        int $anoLancamento,
        Genero $genero,
        // Os primeiros parâmetros são herdados da classe Titulo.
        public readonly int $duracaoEmMinutos,
    ) {
        parent::__construct($nome, $anoLancamento, $genero);
    }
}

// src/Modelo/Serie.php
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
```

Implementação em `index.php`:
```PHP
<?php

require __DIR__ . '/src/Modelo/Filme.php';
require __DIR__ . '/src/Modelo/Genero.php';
require __DIR__ . '/src/Modelo/Serie.php';

echo "Bem-vindo(a) ao Screen Match!\n";

$filme = new Filme(
    "Thor: Ragnarok", 
    2021, 
    Genero::SUPERHEROI,
    180,
);
$filme->avalia(10);
$filme->avalia(10);
$filme->avalia(5);
$filme->avalia(5);

var_dump($filme);

echo $filme->media() . "\n";
echo $filme->anoLancamento . "\n";
echo $filme->genero->descricao() . "\n";

$serie = new Serie(
    "Lost",
    2007,
    Genero::DRAMA,
    10,
    20,
    30
);

echo $serie->anoLancamento . "\n";
$serie->avalia(8);
echo $serie->media() . "\n";
```

# Implementações diferentes
## Calculadora de maratona
Queremos calcular quantos minutos uma maratona de filmes e séries teria.

A implementação a seguir não usa herança, e aumenta a complexidade do código para cada subclasse de `Titulo`:
```PHP
// src/Calculos/CalculadoraDeMaratona.php, sem uso de herança.
<?php

class CalculadoraDeMaratona
{
    private int $duracaoMaratona = 0;

    public function inclui(Titulo $titulo): void
    {
        if ($titulo instanceof Filme) {
            $this->duracaoMaratona += $titulo->duracaoEmMinutos;
        } elseif ($titulo instanceof Serie) {
            $this->duracaoMaratona += $titulo->numeroDeTemporadas * $titulo->episodiosPorTemporada * $titulo->minutosPorEpisodio;
        }
    }

    public function duracaoEmMinutos(): int
    {
        return $this->duracaoMaratona;
    }
}
```

Se usássemos um método herdado da classe `Titulo` com a duração dos títulos, isso ficaria mais facilitado:

```PHP
// src/Calculos/CalculadoraDeMaratona.php, com uso de herança.
<?php

class CalculadoraDeMaratona
{
    private int $duracaoMaratona = 0;

    public function inclui(Titulo $titulo): void
    {
        // Não houve necessidade de usar ifs.
        $this->duracaoMaratona += $titulo->duracaoEmMinutos();
    }

    public function duracaoEmMinutos(): int
    {
        return $this->duracaoMaratona;
    }
}
```

Veja como ficar a implementação das classes de modelo: 
```PHP
// src/Modelo/Titulo.php
<?php

class Titulo {
    // Resto do código 
    public function duracaoEmMinutos(): int
    {
        return 0;
    }
}

// src/Modelo/Filme.php
<?php

require_once __DIR__ . '/Titulo.php';

class Filme extends Titulo {
    // Resto do código
    public function duracaoEmMinutos(): int
    {
        return $this->duracaoEmMinutos;
    }
}

// src/Modelo/Serie.php
<?php

require_once __DIR__ . '/Titulo.php';

class Serie extends Titulo {
    // Resto do código

    public function duracaoEmMinutos(): int
    {
        return $this->numeroDeTemporadas * $this->episodiosPorTemporada * $this->minutosPorEpisodio;
    }
}
```
