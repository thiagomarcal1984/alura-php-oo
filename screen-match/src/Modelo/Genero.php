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
