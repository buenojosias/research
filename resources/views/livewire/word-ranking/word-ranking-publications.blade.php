<x-table>
    <x-slot name="header">
        <th>Título</th>
        <th>Seção</th>
        <th>Contagem</th>
        <th></th>
    </x-slot>
    {{ $data['id'] }}
    <x-slot name="body">
        @if ($internals)
        @dump($internals)
            {{-- @foreach ($publications as $publication)
                <tr>
                    <td>{{ $publication->title }}</td>
                    <td>{{ $publication->section === 'abstract' ? 'Resumo' : 'Seção textual' }}</td>
                    <td>XXX</td>
                    <td>
                        <x-ts-button outline wire:click="selectResult" text="Ver contexto" />
                    </td>
                </tr>
            @endforeach --}}
        @endif
    </x-slot>
</x-table>
