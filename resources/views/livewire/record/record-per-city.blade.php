<div>
    <x-page-header title="Estatísticas por cidade" />
    <div class="sm:flex gap-x-6">
        @include('includes.records-nav')
        <div class="flex-auto grid grid-cols-5 gap-x-6">
            <div class="col-span-2">
                <x-table class="screen">
                    @slot('header')
                        <th>Cidade</th>
                        <th width="1">Produções</th>
                    @endslot
                    @slot('body')
                        @foreach ($productionsByCity as $key => $city)
                            <tr>
                                @if ($key == '')
                                    <td>
                                        <span class="cursor-pointer" wire:click="selectWithoutCity">
                                            Não informada
                                        </span>
                                    </td>
                                @else
                                    <td>
                                        <span class="cursor-pointer" wire:click="selectCity('{{ $key }}')">
                                            {{ $key }} ({{ $city->first()->state->abbreviation ?? '' }})
                                        </span>
                                    </td>
                                @endif
                                <td>{{ $city->count() }}</td>
                            </tr>
                        @endforeach
                    @endslot
                </x-table>
            </div>

            <div class="col-span-3 space-y-4">
                @if ($selectedCity && $cityProductions)
                    <x-table>
                        <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                            <h4>Publicações da cidade: {{ $selectedCity }}</h4>
                            <x-ts-button wire:click="selectCity('')" icon="x-mark" outline />
                        </div>
                        <x-slot name="header">
                            <th>Título</th>
                            <th width="1">Ano</th>
                        </x-slot>
                        <x-slot name="body">
                            @foreach ($cityProductions as $production)
                                <tr>
                                    <td class="!text-wrap">
                                        <a
                                            href="{{ route('project.bibliometrics.productions.show', [$project, $production]) }}">
                                            {{ $production->full_title }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $production->year }}
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-table>
                @else
                    <x-ts-card>
                        Selecione uma cidade na tabela <span class="lg:hidden">abaixo</span> <span
                            class="hidden lg:inline-flex">ao lado</span> para listar as respectivas produções.
                    </x-ts-card>
                @endif

                <x-table label="Quantidade por ano">
                    <x-slot name="header">
                        <tr>
                            <th>Cidades</th>
                            @foreach ($years as $year)
                                <th class="text-center">{{ $year }}</th>
                            @endforeach
                            <th class="text-center">Total</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($tableByYear as $city => $years)
                            <tr>
                                <td>{{ $city != '' ? $city : 'Não informada' }}</td>
                                @foreach ($years as $year)
                                    <td class="text-center">{{ $year ?? 0 }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        <tr>
                            <td class="font-semibold">Total</td>
                            @foreach ($years as $key => $year)
                                <td class="text-center font-semibold">{{ $yearTotals[$key] }}</td>
                            @endforeach
                        </tr>
                    </x-slot>
                </x-table>

                <x-table label="Quantidade por tipo">
                    <x-slot name="header">
                        <tr>
                            <th>Cidades</th>
                            @foreach ($types as $type)
                                <th class="text-center">{{ $type }}</th>
                            @endforeach
                            <th class="text-center">Total</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($tableByType as $city => $types)
                            <tr>
                                <td>{{ $city != '' ? $city : 'Não informada' }}</td>
                                @foreach ($types as $type)
                                    <td class="text-center">{{ $type ?? 0 }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        <tr>
                            <td class="font-semibold">Total</td>
                            @foreach ($types as $key => $type)
                                <td class="text-center font-semibold">{{ $typeTotals[$key] }}</td>
                            @endforeach
                        </tr>
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
</div>
