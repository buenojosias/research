<div class="flex-1">
    <x-table>
        <div class="table-header flex justify-between items-center">
            <div class="w-1/2">
                <x-ts-input wire:model.live.debounce="q" placehoder="Buscar citação" icon="magnifying-glass" />
            </div>
            <div>
                <x-ts-button text="Adicionar citação" />
            </div>
        </div>
        <x-slot:header>
            <th>Tipo</th>
            <th>Referência</th>
            <th>Citação</th>
            <th></th>
        </x-slot>
        <x-slot:body>
            @foreach ($citations as $citation)
                <tr>
                    <td>{{ $citation->type }}</td>
                    <td>
                        {{ $citation->reference->short_author }},
                        {{ $citation->reference->year }}
                    </td>
                    <td class="!text-wrap">
                        {{ $citation->content }}
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
