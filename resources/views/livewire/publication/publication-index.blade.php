<section>
    <div class="header">
        <div>
            <h1>Publicações da pesquisa</h1>
            <h2>{{ $research->title }}</h2>
        </div>
        <x-ts-button text="Adicionar publicação" />
    </div>

    <x-ts-card>
        <x-table>
            <x-slot name="header">
                <th>Tipo</th>
                <th>Autor</th>
                <th>Título</th>
                <th>Ano</th>
                <th>Repositório</th>
                <th>Termos pesquisados</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($publications as $publication)
                    <tr>
                        <td>{{ $publication->type }}</td>
                        <td>
                            {{ Str::upper($publication->author_lastname) }},
                            {{ $publication->author_forename }}
                        </td>
                        <td class="!text-wrap">
                            {{ $publication->title }}
                            {{ $publication->subtitle ? ': '. $publication->subtitle : '' }}
                        </td>
                        <td>{{ $publication->year }}</td>
                        <td>{{ $publication->repository }}</td>
                        <td>
                            @foreach ($publication->searched_terms as $term)
                                {{ $term }}
                                @if (!$loop->last) + @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
    </x-ts-card>
</section>
