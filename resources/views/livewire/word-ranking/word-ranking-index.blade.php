<section>
    <x-page-header title="Ranking de palavras">
        <x-ts-button :href="route('project.bibliometrics.wordrankings.create', $project)" wire:navigate text="Nova análise" />
    </x-page-header>
    <x-table>
        <x-slot name="header">
            <th>Título ou data</th>
            <th>Seções buscadas</th>
            <th>Tipos de produção</th>
            <th>Produções encontradas</th>
            <th>Contagem total</th>
        </x-slot>
        <x-slot name="body">
            @foreach ($wordrankings as $wr)
                <tr>
                    <td class="!text-wrap">
                        <a href="{{ route('project.bibliometrics.wordrankings.show', [$project, $wr]) }}" wire:navigate>
                            {{ $wr->title ?? $wr->created_at->format('d/m/Y') }}</td>
                        </a>
                    <td>
                        @foreach ($wr['filters']['internal_sections'] as $section)
                            {{ $section }}
                            @if (!$loop->last)
                                /
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($wr['filters']['production_types'] as $type)
                            {{ $type }}
                            @if (!$loop->last)
                                /
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $wr->productions_count }}</td>
                    <td>{{ $wr->total_count }}</td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
</section>
