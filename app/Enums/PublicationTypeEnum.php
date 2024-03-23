<?php

namespace App\Enums;

enum PublicationTypeEnum: string
{
    case DISSERTACAO = 'dissertação';
    case TESE = 'tese';
    case PERIÓDICO = 'periódico';
    case ARTIGOCIENTIFICO = 'artigoCientífico';

}
