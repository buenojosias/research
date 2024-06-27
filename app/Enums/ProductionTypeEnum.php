<?php

namespace App\Enums;

enum ProductionTypeEnum: string
{
    case DISSERTACAO = 'Dissertação';
    case TESE = 'Tese';
    case PERIODICO = 'Periódico';
    case ARTIGO_CIENTIFICO = 'Artigo científico';
    case CAPITULO_LIVRO = 'Capítulo de livro';
    case RESUMO_EXPANDIDO = 'Resumo expandido';

    public function plural(): string
    {
        return match($this) {
            self::DISSERTACAO => 'Dissertações',
            self::TESE => 'Teses',
            self::PERIODICO => 'Periódicos',
            self::ARTIGO_CIENTIFICO => 'Artigos científicos',
            self::CAPITULO_LIVRO => 'Capítulos de livro',
            self::RESUMO_EXPANDIDO => 'Resumos expandidos',
        };
    }

}
