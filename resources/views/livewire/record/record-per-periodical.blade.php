<div>
    <x-page-header title="Estatísticas por periódico" />
    <div class="sm:flex gap-x-6">
        @include('includes.records-nav')
        <div class="flex-auto grid grid-cols-5 gap-x-6">
            <div class="col-span-2">
                <x-table class="screen">
                    @slot('header')
                        <th>Periódico</th>
                        <th width="1">Produções</th>
                    @endslot
                    @slot('body')
                        @foreach ($productionsByPeriodical as $key => $periodical)
                            <tr>
                                @if ($key == '')
                                    <td>
                                        <span class="cursor-pointer" wire:click="selectWithoutperiodical">
                                            Não informado
                                        </span>
                                    </td>
                                @else
                                    <td>
                                        <span class="cursor-pointer" wire:click="selectPeriodical('{{ $key }}')">
                                            {{ $key }}
                                        </span>
                                    </td>
                                @endif
                                <td>{{ $periodical->count() }}</td>
                            </tr>
                        @endforeach
                    @endslot
                </x-table>
            </div>

            <div class="col-span-3 space-y-4">
                @if ($selectedPeriodical && $periodicalProductions)
                    <x-table>
                        <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                            <h4>Publicações do periódico: {{ $selectedPeriodical }}</h4>
                            <x-ts-button wire:click="selectPeriodical('')" icon="x-mark" outline />
                        </div>
                        <x-slot name="header">
                            <th>Título</th>
                            <th width="1">Ano</th>
                        </x-slot>
                        <x-slot name="body">
                            @foreach ($periodicalProductions as $production)
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
                        Selecione um periódico na tabela <span class="lg:hidden">abaixo</span> <span
                            class="hidden lg:inline-flex">ao lado</span> para listar as respectivas produções.
                    </x-ts-card>
                @endif

                <x-table label="Quantidade por ano">
                    <x-slot name="header">
                        <tr>
                            <th>Periódicos</th>
                            @foreach ($years as $year)
                                <th class="text-center">{{ $year }}</th>
                            @endforeach
                            <th class="text-center">Total</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($tableByYear as $periodical => $years)
                            <tr>
                                <td>{{ $periodical ?? 'Não informado' }}</td>
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

                <x-table label="Quantidade por repositório">
                    <x-slot name="header">
                        <tr>
                            <th>Periódicos</th>
                            @foreach ($repositories as $repository)
                                <th class="text-center">{{ $repository }}</th>
                            @endforeach
                            <th class="text-center">Total</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($tableByRepository as $periodical => $repositories)
                            <tr>
                                <td>{{ $periodical ?? 'Não informado' }}</td>
                                @foreach ($repositories as $repository)
                                    <td class="text-center">{{ $repository ?? 0 }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        <tr>
                            <td class="font-semibold">Total</td>
                            @foreach ($repositories as $key => $repository)
                                <td class="text-center font-semibold">{{ $repositoryTotals[$key] }}</td>
                            @endforeach
                        </tr>
                    </x-slot>
                </x-table>

            </div>
        </div>
    </div>
</div>
