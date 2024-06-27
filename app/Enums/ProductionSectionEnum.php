<?php

namespace App\Enums;

enum ProductionSectionEnum: string
{
    case RESUMO = 'resumo';
    case INTRODUCAO = 'introducao';
    case METODOLOGIA = 'metodologia';
    case RESULTADOS = 'resultados';
    case DISCUSSAO = 'discussao';
    case CONCLUSAO = 'conclusao';

    public function label(): string
    {
        return match($this) {
            self::RESUMO => 'Resumo',
            self::INTRODUCAO => 'Introdução',
            self::METODOLOGIA => 'Metodologia',
            self::RESULTADOS => 'Resultados',
            self::DISCUSSAO => 'Discussão',
            self::CONCLUSAO => 'Conclusão',
        };
    }
}
