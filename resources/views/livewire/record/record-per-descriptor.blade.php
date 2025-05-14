<div>
    <x-ts-toast />
    <x-page-header title="Estatísticas por descritores" />
    <div class="sm:flex gap-x-6">
        @include('includes.records-nav')
        <div class="flex-auto grid grid-cols-5 gap-x-6">
            <div class="col-span-2">
                <x-table>
                    @slot('header')
                        <th>Combinações</th>
                        <th width="1">Produções</th>
                    @endslot
                    @slot('body')
                        @foreach ($tableByWord as $word => $total)
                            <tr>
                                <td>
                                    <span class="cursor-pointer text-wrap" wire:click="selectWord('{{ $word }}')">
                                        {{ $word }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $total['total'] }}</td>
                            </tr>
                        @endforeach
                    @endslot
                </x-table>
            </div>
            <div class="col-span-3 space-y-3">
                @if ($selectedWords && $records->count())
                    <x-table>
                        <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                            <h4>Produções com o descritor: {{ $descriptor }}</h4>
                            <x-ts-button wire:click="selectWord('')" icon="x-mark" outline />
                        </div>
                        <x-slot name="header">
                            <th width="20">
                                @if (!empty($selectedProductions))
                                    <x-ts-dropdown icon="ellipsis-vertical" static>
                                        <x-ts-dropdown.items text="Adicionar a grupo"
                                            wire:click="$dispatch('open-slide')" />
                                    </x-ts-dropdown>
                                @endif
                            </th>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Autor(es)</th>
                            <th>Ano</th>
                            <th width="10"></th>
                        </x-slot>
                        <x-slot name="body">
                            @foreach ($records as $record)
                                <tr>
                                    <td>
                                        <x-ts-checkbox wire:model.live="selectedProductions"
                                            name="selectedProductions[]" :value="$record->id" />
                                    </td>
                                    <td class="!text-wrap">{{ $record->full_title }}</td>
                                    <td>{{ $record->type }}</td>
                                    <td class="!text-wrap">
                                        @foreach ($record->authors as $author)
                                            {{ $author->forename . ' ' . $author->lastname }}{!! !$loop->last ? ';<br>' : '' !!}
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{ $record->year }}</td>
                                    <td>
                                        <x-ts-button icon="eye"
                                            x-on:click="$dispatch('preview-production', { id: {{ $record->id }} })" sm
                                            flat />
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-table>
                @else
                    <x-ts-card>
                        Selecione um descritor na tabela <span class="lg:hidden">abaixo</span> <span
                            class="hidden lg:inline-flex">ao lado</span> para listar as respectivas produções.
                    </x-ts-card>
                @endif
                <x-table label="Lista por tipo de produção" collapsable>
                    <x-slot name="header">
                        <tr>
                            <th>Descritores</th>
                            @foreach ($types as $type)
                                <th class="text-center">{{ $type }}</th>
                            @endforeach
                            <th class="text-center">Total</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($tableByType as $word => $types)
                            <tr>
                                <td>{{ $word }}</td>
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
                <x-table label="Lista por repositório" collapsable>
                    <x-slot name="header">
                        <tr>
                            <th>Descritores</th>
                            @foreach ($repositories as $repository)
                                <th class="text-center">{{ $repository }}</th>
                            @endforeach
                            <th class="text-center">Total</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($tableByRepository as $word => $repositories)
                            <tr>
                                <td>{{ $word }}</td>
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
                <x-table label="Lista por ano" collapsable>
                    <x-slot name="header">
                        <tr>
                            <th>Descritores</th>
                            @foreach ($years as $year)
                                <th class="text-center">{{ $year }}</th>
                            @endforeach
                            <th class="text-center">Total</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($tableByYear as $word => $years)
                            <tr>
                                <td>{{ $word }}</td>
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
            </div>
        </div>


        {{-- <div class="flex-auto sm:grid grid-cols-6 gap-x-6">
            <div class="col-span-3">
                <x-ts-card header="Filtros">
                    <x-ts-label label="Tipos" />
                    @foreach ($bibliometricTypes as $type)
                        <div class="w-full mt-1">
                            <x-ts-checkbox :label="$type" wire:model.live="selectedTypes" name="selectedTypes[]"
                                :value="$type" />
                        </div>
                    @endforeach
                    <hr class="my-4">
                    <x-ts-label label="Combinação de descritores" />
                    @foreach ($bibliometricTerms as $term)
                        <div class="w-full mt-1">
                            <x-ts-checkbox :label="$term" wire:model.live="selectedWords" name="selectedWords[]"
                                :value="$term" />
                        </div>
                    @endforeach
                    <hr class="my-4">
                    <x-ts-toggle label="Incluir descartadas" wire:model.live="withTrashed" />
                </x-ts-card>
            </div>

            <div class="col-span-6">
                <x-table>
                    <x-slot name="header">
                        <th>Tipo</th>
                        <th width="1">Resultados</th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($records as $key => $record)
                            <tr>
                                <td x-data="{ showProductions: false }">
                                    <span class="font-semibold cursor-pointer"
                                        x-on:click="showProductions = !showProductions">{{ $key }}</span>
                                    <div class="mt-2 rounded border bg-gray-50" x-show="showProductions" x-transition>
                                        <ul>
                                            @foreach ($record as $production)
                                                <li class="border-b p-2 !text-wrap">
                                                    {{ $production->full_title }}
                                                    ({{ $production->year }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    {{ $record->count() }}
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>
                @if (!$selectedWords)
                    <div class="bg-white text-center py-6">Selecione um ou mais descritores para ver a quantidade
                        de produções encontradas.</div>
                @elseif (!count($records))
                    <div class="bg-white text-center py-6">Nenhuma produção encontrada. Selecione mais descritores.</div>
                @endif
            </div>
        </div> --}}
    </div>
    @if ($selectedWords && $records->count())
        @livewire('group.attach-group', ['project' => $project])
    @endif
    @livewire('production.production-slide', ['project' => $project])
</div>
