<?php

namespace App\Enums;

enum PublicationTypeEnum: string
{
    case DISSERTACAO = 'Dissertação';
    case TESE = 'Tese';
    case PERIODICO = 'Periódico';
    case ARTIGO_CIENTIFICO = 'Artigo científico';

}
