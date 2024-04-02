<section>
    <div class="header">
        <div>
            <h1>Palavras-chave</h1>
        </div>
    </div>
    <div class="flex flex-col lg:flex-row-reverse gap-6">
        <div class="lg:w-2/3">
            @if ($selectedKeyword && $kw_publ)
                <x-table>
                    <div class="px-4 py-2 flex justify-between items-center text-gray-800 font-semibold">
                        <h4>Publicações com a palavra-chave: {{ $selectedKeyword }}</h4>
                        <x-ts-button wire:click="selectWord('')" icon="x-mark" outline />
                    </div>
                    <x-slot name="header">
                        <th>Título</th>
                        <th>Palavras-chave</th>
                    </x-slot>
                    <x-slot name="body">
                        @forelse ($kw_publ as $kw)
                            <tr>
                                <td class="!text-wrap">
                                    <a href="{{ route('researches.publications.show', [$research, $kw->publication]) }}">
                                        {{ $kw->publication->title }} ({{ $kw->publication->year }})
                                </td>
                                </a>
                                <td>
                                    @foreach ($kw->data as $kws)
                                        {{ $kws }}
                                        @if (!$loop->last)
                                            /
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @empty
                            ...
                        @endforelse
                    </x-slot>
                </x-table>
            @endif
        </div>
        <div class="lg:w-1/3">
            <x-table>
                <x-slot name="header">
                    <th class="cursor-pointer" wire:click="ksort">Palavra</th>
                    <th class="cursor-pointer" wire:click="arsort">Publicações</th>
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
