<div>
    <x-page-header title="Estatísticas por autor" />
    <div class="sm:flex gap-x-6">
        @include('includes.records-nav')
        <div class="flex-auto grid grid-cols-6 gap-x-6">
            <div class="col-span-2">
                <x-table class="screen">
                    <x-slot name="header">
                        <th class="cursor-pointer" wire:click="ksort">Autor</th>
                        <th class="cursor-pointer" wire:click="arsort">Produções</th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($authors as $name => $details)
                            <tr>
                                <td>
                                    <span class="cursor-pointer"
                                        wire:click="selectAuthor('{{ $name }}', {{ json_encode($details['ids']) }})">{{ $name }}</span>
                                </td>
                                <td width="1" class="text-center">{{ $details['count'] }}</td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>

            <div class="col-span-3">
                @if ($selectedAuthor && $authorProductions)
                    <x-table>
                        <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                            <h4>Publicações do autor: {{ $selectedAuthorName }}</h4>
                            <x-ts-button wire:click="selectAuthor('', '')" icon="x-mark" outline />
                        </div>
                        <x-slot name="header">
                            <th>Título</th>
                            <th width="1">Ano</th>
                        </x-slot>
                        <x-slot name="body">
                            @foreach ($authorProductions as $production)
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
                        Selecione um autor na tabela <span class="lg:hidden">abaixo</span> <span
                            class="hidden lg:inline-flex">ao lado</span> para listar as respectivas produções.
                    </x-ts-card>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
