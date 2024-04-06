<section>
    <div class="header">
        <div>
            <h1>Ranking de palavras</h1>
        </div>
        <div>
            <x-ts-button :href="route('researches.wordrankings.create', $research)" wire:navigate text="Nova análise" />
        </div>
    </div>
    <x-table>
        <x-slot name="header">
            <th>Título ou data</th>
            <th>Seções buscadas</th>
            <th>Tipos de publicação</th>
            <th>Publicações encontradas</th>
            <th>Contagem total</th>
        </x-slot>
        <x-slot name="body">
            @foreach ($wordrankings as $wr)
                <tr>
                    <td class="!text-wrap">
                        <a href="{{ route('researches.wordrankings.show', [$research, $wr]) }}" wire:navigate>
                            {{ $wr->title ?? $wr->created_at->format('d/m/Y') }}</td>
                        </a>
                    <td>
                        @foreach ($wr['filters']['internal_sections'] as $section)
                            {{ $section === 'body' ? 'Conteúdo' : 'Resumo' }}
                            @if (!$loop->last)
                                /
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($wr['filters']['publication_types'] as $type)
                            {{ $type }}
                            @if (!$loop->last)
                                /
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $wr->publications_count }}</td>
                    <td>{{ $wr->total_count }}</td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
</section>
