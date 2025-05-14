<div>
    <x-page-header title="Estatísticas por programa" />
    <div class="sm:flex gap-x-6">
        @include('includes.records-nav')
        <div class="flex-auto grid grid-cols-5 gap-x-6">
            <div class="col-span-2">
                <x-table class="screen">
                    @slot('header')
                        <th>Programa</th>
                        <th width="1">Produções</th>
                    @endslot
                    @slot('body')
                        @foreach ($productionsByProgram as $program => $productions)
                            <tr>
                                @if ($program == '')
                                    <td>
                                        <span class="cursor-pointer" wire:click="selectWithoutProgram">
                                            Não informado
                                        </span>
                                    </td>
                                @else
                                    <td class="!text-wrap">
                                        <span class="cursor-pointer" wire:click="selectProgram('{{ $program }}')">
                                            {{ $program }}
                                        </span>
                                    </td>
                                @endif
                                <td>{{ $productions->count() }}</td>
                            </tr>
                        @endforeach
                    @endslot
                </x-table>
            </div>
            <div class="col-span-3 space-y-4">
                @if ($selectedProgram && $programProductions)
                    <x-table>
                        <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                            <h4>Publicações do progama: {{ $selectedProgram }}</h4>
                            <x-ts-button wire:click="selectProgram('')" icon="x-mark" outline />
                        </div>
                        <x-slot name="header">
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Ano</th>
                            <th width="10"></th>
                        </x-slot>
                        <x-slot name="body">
                            @foreach ($programProductions as $program => $productions)
                                <tr>
                                    <td colspan="4" class="bg-gray-100 py-1.5 font-semibold text-gray-800">
                                        {{ $program }}
                                    </td>
                                </tr>
                                @foreach ($productions as $production)
                                    <tr>
                                    <tr>
                                        <td class="!text-wrap">{{ $production->full_title }}</td>
                                        <td>{{ $production->type }}</td>
                                        <td>{{ $production->year }}</td>
                                        <td>
                                            <x-ts-button icon="eye"
                                                x-on:click="$dispatch('preview-production', { id: {{ $production->id }} })"
                                                sm flat />
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </x-slot>
                    </x-table>
                @else
                    <x-ts-card>
                        Selecione um programa na tabela <span class="lg:hidden">abaixo</span> <span
                            class="hidden lg:inline-flex">ao lado</span> para listar as respectivas produções.
                    </x-ts-card>
                @endif
                <x-table label="Quantidade por ano" collapsable>
                    <x-slot name="header">
                        <tr>
                            <th>Programas</th>
                            @foreach ($years as $year)
                                <th class="text-center">{{ $year }}</th>
                            @endforeach
                            <th class="text-center">Total</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($tableByYear as $program => $years)
                            <tr>
                                <td class="!text-wrap">{{ $program ?? 'Não informado' }}</td>
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
                <x-table label="Quantidade por tipo" exportable="programa_ano" collapsable>
                    <x-slot name="header">
                        <tr>
                            <th>Programas</th>
                            @foreach ($types as $type)
                                <th class="text-center">{{ $type }}</th>
                            @endforeach
                            <th class="text-center">Total</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($tableByType as $program => $types)
                            <tr>
                                <td class="!text-wrap">{{ $program ?? 'Não informado' }}</td>
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
    @livewire('production.production-slide', ['project' => $project])
</div>
