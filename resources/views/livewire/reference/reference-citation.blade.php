<div>
    <x-page-header title="Citações da referência" :subtitle="
        $reference->title .
        ' ('.
        $reference->short_author.', '.
        $reference->year .
        ')'
    " />

    {{-- @foreach ($citations as $title => $cits)
        <p class="text-lg font-semibold">{{ $title }}</p>
        <ul class="space-y-2">
            @foreach ($cits as $citation)
            <li>{{ $citation->content }}</li>
            @endforeach
        </ul>
    @endforeach --}}

    <x-table>
        <div class="table-header flex justify-between items-center">
            <div class="w-1/2">
                <x-ts-input wire:model.live.debounce="q" placehoder="Buscar citação" icon="magnifying-glass" />
            </div>
        </div>
        <x-slot:header>
            <th>Tipo</th>
            <th>Citação</th>
            <th>Produção</th>
            <th></th>
        </x-slot>
        <x-slot:body>
            @foreach ($citations as $citation)
                <tr>
                    <td>{{ $citation->type }}</td>
                    <td class="!text-wrap">
                        {{ $citation->content }}
                    </td>
                    <td class="!text-wrap">
                        {{ $citation->production->subtitle ? $citation->production->title . ': ' . $citation->production->subtitle : $citation->production->title }}
                        ({{ $citation->production->year }})
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </x-slot>
        <x-slot:pagination>
            {{ $citations->links() }}
        </x-slot>
    </x-table>
</div>
