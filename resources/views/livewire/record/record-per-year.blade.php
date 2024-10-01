<div>
    <x-page-header title="Estatísticas por ano" />
    <div class="sm:flex gap-x-6">
        @include('includes.records-nav')
        <div class="flex-auto grid grid-cols-5 gap-x-6">
            <div class="col-span-2">
                <x-table>
                    @slot('header')
                        <th>Ano</th>
                        <th width="1">Produções</th>
                    @endslot
                    @slot('body')
                        @foreach ($productionsByYear as $year => $productions)
                            <tr>
                                <td>
                                    <span class="cursor-pointer" wire:click="selectyear('{{ $year }}')">
                                        {{ $year }}
                                    </span>
                                </td>
                                <td>{{ $productions->count() }}</td>
                            </tr>
                        @endforeach
                    @endslot
                </x-table>
            </div>

            <div class="col-span-3 space-y-4">
                {{-- @if ($selectedState && $stateProductions)
                    <x-table>
                        <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                            <h4>Publicações do estado: {{ $states->find($selectedState)->name }}</h4>
                            <x-ts-button wire:click="selectState('')" icon="x-mark" outline />
                        </div>
                        <x-slot name="header">
                            <th>Título</th>
                            <th width="1">Ano</th>
                        </x-slot>
                        <x-slot name="body">
                            @foreach ($stateProductions as $production)
                                <tr>
                                    <td class="!text-wrap">
                                        <a
                                            href="{{ route('project.bibliometrics.productions.show', [$project, $production]) }}">
                                            {{ $production->full_title }}<br>
                                            ({{ $production->city ?? 'Cidade não informada' }})
                                        </a>
                                    </td>
                                    <td class="!text-wrap">
                                        {{ $production->year }}
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-table>
                @else
                    <x-ts-card>
                        Selecione um estado na tabela <span class="lg:hidden">abaixo</span> <span
                            class="hidden lg:inline-flex">ao lado</span> para listar as respectivas produções.
                    </x-ts-card>
                @endif --}}

                <x-table label="Lista por tipo">
                    <x-slot name="header">
                        <tr>
                            <th>Tipos de produção</th>
                            @foreach ($years as $year)
                                <th class="text-center">{{ $year }}</th>
                            @endforeach
                            <th class="text-center">Total</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($types as $type)
                            <tr>
                                <td>{{ $type }}</td>
                                @foreach ($years as $year)
                                    <td class="text-center">{{ $tableByType[$type][$year] ?? 0 }}</td>
                                @endforeach
                                <td class="text-center">{{ $typeTotals[$type] ?? 0 }}</td>
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td class="font-semibold">Total</td>
                            @foreach ($years as $year)
                                <td class="text-center font-semibold">{{ $tableByType['total'][$year] ?? 0 }}</td>
                            @endforeach
                            <td class="text-center font-semibold">{{ $typeTotals['total'] ?? 0 }}</td>
                        </tr> --}}
                    </x-slot>
                </x-table>

                <x-table label="Lista por estado">
                    <x-slot name="header">
                        <tr>
                            <th>Estado</th>
                            @foreach ($years as $year)
                                <th class="text-center">{{ $year }}</th>
                            @endforeach
                            <th class="text-center">Total</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($states as $key => $state)
                            <tr>
                                <td>{{ $state ?? 'Não informado' }}</td>
                                @foreach ($years as $year)
                                    <td class="text-center">{{ $tableByState[$state][$year] ?? 0 }}</td>
                                @endforeach
                                <td class="text-center">{{ $stateTotals[$state] ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>

            </div>
        </div>
    </div>
</div>
