<div>
    <x-page-header title="Estatísticas por estado" />
    <div class="sm:flex gap-x-6">
        @include('includes.records-nav')
        <div class="flex-auto grid grid-cols-5 gap-x-6">
            <div class="col-span-2">
                <x-table class="screen">
                    @slot('header')
                        <th>Estado</th>
                        <th width="1">Produções</th>
                    @endslot
                    @slot('body')
                        @foreach ($groupByRegion as $region => $regionStates)
                            <tr>
                                <td colspan="2" class="bg-gray-100 py-1.5 text-center font-semibold text-gray-800">
                                    {{ $region }}
                                    ({{ $regionStates->sum('productions_count') }} produções)
                                </td>
                            </tr>
                            @foreach ($regionStates as $state)
                                <tr>
                                    <td>
                                        <span class="cursor-pointer" wire:click="selectState('{{ $state->id }}')">
                                            {{ $state->name }}
                                            ({{ $state->abbreviation }})
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $state->productions_count }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                        {{-- @foreach ($states as $state)
                            <tr>
                                <td>
                                    <span class="cursor-pointer" wire:click="selectState('{{ $state->id }}')">
                                        {{ $state->name }}
                                        ({{ $state->abbreviation }})
                                    </span>
                                </td>
                                <td>{{ $state->productions_count }}</td>
                            </tr>
                        @endforeach --}}
                    @endslot
                </x-table>
            </div>

            <div class="col-span-3">
                @if ($selectedState && $stateProductions)
                    <x-table>
                        <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                            <h4>Publicações do estado: {{ $states->find($selectedState)->name }}</h4>
                            <x-ts-button wire:click="selectState('')" icon="x-mark" outline />
                        </div>
                        <x-slot name="header">
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Ano</th>
                            <th width="10"></th>
                        </x-slot>
                        <x-slot name="body">
                            @foreach ($stateProductions as $city => $productions)
                                <tr>
                                    <td colspan="4" class="bg-gray-100 py-1.5 font-semibold text-gray-800">
                                        {{ $city }}
                                    </td>
                                </tr>
                                @foreach ($productions as $production)
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
                        Selecione um estado na tabela <span class="lg:hidden">abaixo</span> <span
                            class="hidden lg:inline-flex">ao lado</span> para listar as respectivas produções.
                    </x-ts-card>
                @endif
            </div>
        </div>
    </div>
    @livewire('production.production-slide', ['project' => $project])
</div>
