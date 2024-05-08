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
}
