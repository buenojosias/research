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
                        @foreach ($cities as $key => $city)
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
                                            {{ $key }}
                                        </span>
                                    </td>
                                @endif
                                <td>{{ $city->count() }}</td>
                            </tr>
                        @endforeach
                    @endslot
                </x-table>
            </div>

            <div class="col-span-3">
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
                                            {{ $production->title }}
                                            @if ($production->subtitle)
                                                : {{ $production->subtitle }}
                                            @endif
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
            </div>
        </div>
    </div>
</div>
