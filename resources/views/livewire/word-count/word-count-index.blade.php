<section>
    <div class="header">
        <div>
            <h1>Contagem de palavras</h1>
        </div>
        <div>
            <x-ts-button :href="route('project.bibliometrics.wordcounts.create', $project)" wire:navigate text="Nova contagem" />
        </div>
    </div>
    <x-table>
        <x-slot name="header">
            <th>Palavra consultada</th>
            <th>Seções</th>
            <th>Resultados</th>
            <th>Contagem</th>
        </x-slot>
        <x-slot name="body">
            @foreach ($wordcounts as $wc)
                <tr>
                    <td class="!text-wrap">
                        <a href="{{ route('project.bibliometrics.wordcounts.show', [$project, $wc]) }}" wire:navigate>
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
                    <td>{{ $wc->productions_count }}</td>
                    <td>{{ $wc->total_count }}</td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
</section>
