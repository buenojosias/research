<section>
    <x-page-header title="Palavras-chave" :subtitle="$project->theme" />
    <div class="flex flex-col lg:flex-row-reverse gap-6">
        <div class="lg:w-2/3">
            @if ($selectedKeyword && $kw_publ)
                <x-table>
                    <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                        <h4>Publicações com a palavra-chave: {{ $selectedKeyword }}</h4>
                        <x-ts-button wire:click="selectWord('')" icon="x-mark" outline />
                    </div>
                    <x-slot name="header">
                        <th>Título</th>
                        <th width="40%">Palavras-chave</th>
                    </x-slot>
                    <x-slot name="body">
                        @forelse ($kw_publ as $kw)
                            <tr>
                                <td class="!text-wrap">
                                    <a href="{{ route('project.bibliometrics.productions.show', [$project, $kw->production]) }}">
                                        {{ $kw->production->title }} ({{ $kw->production->year }})
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
                            </tr>
                        @empty
                            <div class="p-4 border-t">Palavra-chave não encontrada nas produções.</div>
                        @endforelse
                    </x-slot>
                </x-table>
            @else
                <x-ts-card>
                    Selecione uma palavra na tabela <span class="lg:hidden">abaixo</span> <span class="hidden lg:inline-flex">ao lado</span> para ver as produções que a possuem.
                </x-ts-card>
            @endif
        </div>
        <div class="lg:w-1/3">
            <x-table>
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
