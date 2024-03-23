<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $states = [
            [ 'name' => 'Acre', 'abbreviation' => 'AC', 'region' => 'Norte' ],
            [ 'name' => 'Alagoas', 'abbreviation' => 'AL', 'region' => 'Nordeste' ],
            [ 'name' => 'Amazonas', 'abbreviation' => 'AM', 'region' => 'Norte' ],
            [ 'name' => 'Amapá', 'abbreviation' => 'AP', 'region' => 'Norte' ],
            [ 'name' => 'Bahia', 'abbreviation' => 'BA', 'region' => 'Nordeste' ],
            [ 'name' => 'Ceará', 'abbreviation' => 'CE', 'region' => 'Nordeste' ],
            [ 'name' => 'Distrito Federal', 'abbreviation' => 'DF', 'region' => 'Centro-Oeste' ],
            [ 'name' => 'Espírito Santo', 'abbreviation' => 'ES', 'region' => 'Sudeste' ],
            [ 'name' => 'Goiás', 'abbreviation' => 'GO', 'region' => 'Centro-Oeste' ],
            [ 'name' => 'Maranhão', 'abbreviation' => 'MA', 'region' => 'Nordeste' ],
            [ 'name' => 'Minas Gerais', 'abbreviation' => 'MG', 'region' => 'Sudeste' ],
            [ 'name' => 'Mato Grosso do Sul', 'abbreviation' => 'MS', 'region' => 'Centro-Oeste' ],
            [ 'name' => 'Mato Grosso', 'abbreviation' => 'MT', 'region' => 'Centro-Oeste' ],
            [ 'name' => 'Pará', 'abbreviation' => 'PA', 'region' => 'Norte' ],
            [ 'name' => 'Paraíba', 'abbreviation' => 'PB', 'region' => 'Nordeste' ],
            [ 'name' => 'Pernambuco', 'abbreviation' => 'PE', 'region' => 'Nordeste' ],
            [ 'name' => 'Piauí', 'abbreviation' => 'PI', 'region' => 'Nordeste' ],
            [ 'name' => 'Paraná', 'abbreviation' => 'PR', 'region' => 'Sul' ],
            [ 'name' => 'Rio de Janeiro', 'abbreviation' => 'RJ', 'region' => 'Sudeste' ],
            [ 'name' => 'Rio Grande do Norte', 'abbreviation' => 'RN', 'region' => 'Nordeste' ],
            [ 'name' => 'Rondônia', 'abbreviation' => 'RO', 'region' => 'Norte' ],
            [ 'name' => 'Roraima', 'abbreviation' => 'RR', 'region' => 'Norte' ],
            [ 'name' => 'Rio Grande do Sul', 'abbreviation' => 'RS', 'region' => 'Sul' ],
            [ 'name' => 'Santa Catarina', 'abbreviation' => 'SC', 'region' => 'Sul' ],
            [ 'name' => 'Sergipe', 'abbreviation' => 'SE', 'region' => 'Nordeste' ],
            [ 'name' => 'São Paulo', 'abbreviation' => 'SP', 'region' => 'Sudeste' ],
            [ 'name' => 'Tocantins', 'abbreviation' => 'TO', 'region' => 'Norte' ],
        ];

        State::insert($states);
    }
}
