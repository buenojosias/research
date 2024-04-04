<section>
    <div class="header">
        <div>
            <h1>Contagem de palavras</h1>
        </div>
        <div>
            <x-ts-button :href="route('researches.wordcounts.create', $research)" text="Nova contagem" />
        </div>
    </div>
    <x-table>
        <x-slot name="header">
            <th>Termo buscado</th>
            <th>Seções</th>
            <th>Publicações</th>
            <th>Contagem</th>
        </x-slot>
        <x-slot name="body">
            @foreach ($wordcounts as $wc)
                <tr>
                    <td class="!text-wrap">{{ $wc->word }}</td>
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
    </x-table>
</section>
