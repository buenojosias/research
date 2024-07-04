<?php

namespace App\Enums;

enum ReferenceTypeEnum: string
{
    case LIVRO = 'Livro';
    case CAPITULO = 'Capítulo de livro';
    case DISSERTACAO = 'Dissertação';
    case TESE = 'Tese';
}
