<section>
    <div class="header">
        <div>
            <h1>Ranking de palavras</h1>
        </div>
        <div>
            <x-ts-button :href="route('researches.wordrankings.create', $research)" wire:navigate text="Nova análise" />
        </div>
    </div>
    {{-- <x-table>
        <x-slot name="header">
            <th>Termo buscado</th>
            <th>Seções</th>
            <th>Publicações</th>
            <th>Contagem</th>
        </x-slot>
        <x-slot name="body">
            @foreach ($wordcounts as $wc)
                <tr>
                    <td class="!text-wrap">
                        <a href="{{ route('researches.wordcounts.show', [$research, $wc]) }}" wire:navigate>
                            {{ $wc->word }}</td>
                        </a>
                    <td>
                        @foreach ($wc->sections as $section)
                            {{ $section === 'body' ? 'Conteúdo' : 'Resumo' }}
                            @if (!$loop->last)
                                /
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $wc->publications_count }}</td>
                    <td>{{ $wc->total_count }}</td>
                </tr>
            @endforeach
        </x-slot>
    </x-table> --}}
</section>
