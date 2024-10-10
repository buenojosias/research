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
                <x-table label="Lista por tipo" collapsable>
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
                    </x-slot>
                </x-table>

                <x-table label="Lista por estado" collapsable>
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
