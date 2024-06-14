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
                        @foreach ($programs as $key => $program)
                            <tr>
                                @if ($key == '')
                                    <td>
                                        <span class="cursor-pointer" wire:click="selectWithoutProgram">
                                            Não informado
                                        </span>
                                    </td>
                                @else
                                    <td class="!text-wrap">
                                        <span class="cursor-pointer" wire:click="selectProgram('{{ $key }}')">
                                            {{ $key }}
                                        </span>
                                    </td>
                                @endif
                                <td>{{ $program->count() }}</td>
                            </tr>
                        @endforeach
                    @endslot
                </x-table>
            </div>

            <div class="col-span-3">
                @if ($selectedProgram && $programProductions)
                    <x-table>
                        <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                            <h4>Publicações do progama: {{ $selectedProgram }}</h4>
                            <x-ts-button wire:click="selectProgram('')" icon="x-mark" outline />
                        </div>
                        <x-slot name="header">
                            <th>Título</th>
                            <th width="1">Ano</th>
                        </x-slot>
                        <x-slot name="body">
                            @foreach ($programProductions as $production)
                                <tr>
                                    <td class="!text-wrap">
                                        <a
                                            href="{{ route('project.bibliometrics.productions.show', [$project, $production]) }}">
                                            {{ $production->title }}
                                            @if ($production->subtitle)
                                                : {{ $production->subtitle }}
                                            @endif
                                        </a><br>
                                        @if ($production->institution)
                                            ({{ $production->institution }})
                                        @endif
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
                        Selecione um programa na tabela <span class="lg:hidden">abaixo</span> <span
                            class="hidden lg:inline-flex">ao lado</span> para listar as respectivas produções.
                    </x-ts-card>
                @endif
            </div>
        </div>
    </div>
</div>
