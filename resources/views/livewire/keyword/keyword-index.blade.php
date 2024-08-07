<section>
    <x-page-header title="Palavras-chave" :subtitle="$project->theme" />
    <div class="flex flex-col lg:flex-row-reverse gap-6">
        <div class="lg:w-2/3">
            @if ($selectedKeyword && $kw_publ)
                <x-table>
                    <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                        <h4>Publicações com a palavra-chave: {{ $selectedKeyword }}</h4>
                        <x-ts-button wire:click="selectWord('')" icon="x-mark" flat />
                    </div>
                    <x-slot name="header">
                        <th>Título</th>
                        <th width="40%">Palavras-chave</th>
                        <th>Tipo</th>
                        <th width="1"></th>
                    </x-slot>
                    <x-slot name="body">
                        @forelse ($kw_publ as $kw)
                            <tr>
                                <td class="!text-wrap">
                                    <a
                                        href="{{ route('project.bibliometrics.productions.show', [$project, $kw->production]) }}">
                                        {{ $kw->production->title }}
                                        @if ($kw->production->subtitle)
                                            : {{ $kw->production->subtitle }}
                                        @endif
                                        ({{ $kw->production->year }})
                                    </a>
                                </td>
                                <td class="!text-wrap">
                                    @foreach ($kw->data as $kws)
                                        {{ $kws }}
                                        @if (!$loop->last)
                                            /
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{ $kw->production->type }}
                                </td>
                                <td>
                                    <x-ts-button wire:click="deleteProduction({{ $kw->production }})"
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
                                <x-ts-checkbox name="production_types[]" wire:model.live="production_types" :value="$type"
                                    :label="$type" />
                            </x-ts-dropdown.items>
                        @endforeach
                    </x-ts-dropdown>
                </div>
                <x-slot name="header">
                    <th class="cursor-pointer" wire:click="ksort">Palavra</th>
                    <th class="cursor-pointer" wire:click="arsort">Produções</th>
                </x-slot>
                <x-slot name="body">
                    @foreach ($keywords as $key => $keyword)
                        <tr>
                            <td>
                                <span class="cursor-pointer"
                                    wire:click="selectWord('{{ $key }}')">{{ $key }}</span>
                            </td>
                            <td width="1" class="text-center">{{ $keyword }}</td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
    </div>
</section>
