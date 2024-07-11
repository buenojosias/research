<div>
    <x-page-header title="Estatísticas por descritores" />
    <div class="sm:flex gap-x-6">
        @include('includes.records-nav')

        <div class="flex-auto sm:grid grid-cols-6 gap-x-6">

            <div class="col-span-6 mb-6">
                <x-table label="Lista por tipo de produção">
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
                                @foreach($types as $key => $type)
                                    <td class="text-center font-semibold">{{ $typeTotals[$key] }}</td>
                                @endforeach
                            </tr>
                    </x-slot>
                </x-table>
            </div>

            <div class="col-span-6 mb-6">
                <x-table label="Lista por repositório">
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
                                @foreach($repositories as $key => $repository)
                                    <td class="text-center font-semibold">{{ $repositoryTotals[$key] }}</td>
                                @endforeach
                            </tr>
                    </x-slot>
                </x-table>
            </div>

            <div class="col-span-6 mb-6">
                <x-table label="Lista por ano">
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
                                @foreach($years as $key => $year)
                                    <td class="text-center font-semibold">{{ $yearTotals[$key] }}</td>
                                @endforeach
                            </tr>
                    </x-slot>
                </x-table>
            </div>

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

            <div class="col-span-3">
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
                                                    {{ $production->subtitle ? $production->title .': '. $production->subtitle : $production->title }}
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
        </div>
    </div>
</div>
