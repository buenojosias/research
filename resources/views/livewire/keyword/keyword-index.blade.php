<section>
    <x-ts-toast />
    <x-page-header title="Palavras-chave" :subtitle="$project->theme" />
    <div class="flex flex-col lg:flex-row-reverse gap-6">
        <div class="lg:w-2/3">
            @if ($selectedKeyword && $keywordProductions)
                <x-table>
                    <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                        <h4>Publicações com a palavra-chave: {{ $selectedKeyword }}</h4>
                        <x-ts-button wire:click="selectWord('')" icon="x-mark" flat />
                    </div>
                    <x-slot name="header">
                        <th width="10">
                            @livewire('components.bulk-dropdown', ['project' => $project])
                        </th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Ano</th>
                        <th width="40%">Palavras-chave</th>
                        <th width="1"></th>
                    </x-slot>
                    <x-slot name="body">
                        @forelse ($keywordProductions as $production)
                            <tr>
                                <td>
                                    @livewire('components.bulk-checkbox', ['production_id' => $production->id], key($production->id))
                                </td>
                                <td class="!text-wrap">{{ $production->full_title }}</td>
                                <td>{{ $production->type }}</td>
                                <td>{{ $production->year }}</td>
                                <td class="!text-wrap">
                                    @foreach ($production->keywords as $keyword)
                                        {{ $keyword->value }}@if (!$loop->last)
                                            ;
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <x-ts-button icon="eye"
                                        x-on:click="$dispatch('preview-production', { id: {{ $production->id }} })" sm
                                        flat />
                                    <x-ts-button wire:click="deleteProduction({{ $production }})"
                                        icon="archive-box-arrow-down" color="red" flat sm />
                                </td>
                            </tr>
                        @empty
                            <div class="p-4 border-t">Palavra-chave não encontrada nas produções.</div>
                        @endforelse
                    </x-slot>
                </x-table>
            @else
                <x-ts-card>
                    Selecione uma palavra na tabela <span class="lg:hidden">abaixo</span> <span
                        class="hidden lg:inline-flex">ao lado</span> para ver as produções que a possuem.
                </x-ts-card>
            @endif
        </div>
        <div class="lg:w-1/3">
            <x-table class="screen">
                <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                    <x-ts-dropdown>
                        <x-slot:action>
                            <x-ts-button x-on:click="show = !show" sm outline>Tipos de produção</x-ts-button>
                        </x-slot:action>
                        @foreach ($bibliometric->types as $type)
                            <x-ts-dropdown.items>
                                <x-ts-checkbox name="production_types[]" wire:model.live="production_types"
                                    :value="$type" :label="$type" />
                            </x-ts-dropdown.items>
                        @endforeach
                    </x-ts-dropdown>
                </div>
                <x-slot name="header">
                    <th class="cursor-pointer" wire:click="ksort">Palavra</th>
                    <th class="cursor-pointer" wire:click="arsort">Produções</th>
                </x-slot>
                <x-slot name="body">
                    @foreach ($keywords as $keyword => $productions)
                        <tr>
                            <td>
                                <span class="cursor-pointer"
                                    wire:click="selectWord('{{ $keyword }}')">{{ $keyword }}</span>
                            </td>
                            <td width="1" class="text-center">{{ $productions->count() }}</td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
    </div>
    @livewire('production.production-slide', ['project' => $project])
</section>
