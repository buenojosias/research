<?php

namespace App\Enums;

enum SearchSectionEnum: string
{
    case TITULO = 'Título';
    case RESUMO = 'Resumo';
    case PALAVRAS_CHAVE = 'Palavras-chave';
    case TODOS = 'Todos os campos';
}
