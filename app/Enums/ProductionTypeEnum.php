<?php

namespace App\Enums;

enum ProductionTypeEnum: string
{
    case TCC = 'TCC';
    case DISSERTACAO = 'Dissertação';
    case TESE = 'Tese';
    case PERIODICO = 'Periódico';
    case ARTIGO_CIENTIFICO = 'Artigo científico';
    case CAPITULO_LIVRO = 'Capítulo de livro';
    case ANAIS = 'Anais';
    case RELATORIO = 'Relatório';
    case RESUMO_EXPANDIDO = 'Resumo expandido';

    public function plural(): string
    {
        return match($this) {
            self::TCC => 'TCCs',
            self::DISSERTACAO => 'Dissertações',
            self::TESE => 'Teses',
            self::PERIODICO => 'Periódicos',
            self::ARTIGO_CIENTIFICO => 'Artigos científicos',
            self::CAPITULO_LIVRO => 'Capítulos de livro',
            self::ANAIS => 'Anais',
            self::RELATORIO => 'Relatórios',
            self::RESUMO_EXPANDIDO => 'Resumos expandidos',
        };
    }

}
