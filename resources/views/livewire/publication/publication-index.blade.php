<section>
    <div class="header">
        <div>
            <h1>Publicações da pesquisa</h1>
            <h2>{{ $research->title }}</h2>
        </div>
        <x-ts-button text="Adicionar publicação" />
    </div>

    <x-ts-card>
        <div>
            Filtros: Termos Pesquisados, Repositório, Tipo, Idioma, Ano, Periódico, UF, Região <br>
            Busca: Título, Subtítulo
            Ícones: URL, DOI
        </div>
        <x-table>
            <x-slot name="header">
                <th>Autor</th>
                <th>Título</th>
                <th>Ano</th>
                <th>Tipo</th>
                <th>Repositório</th>
                <th>Termos pesquisados</th>
                <th>Instituição</th>
                <th>Programa</th>
                <th>Cidade</th>
                <th>UF</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($publications as $publication)
                    <tr>
                        <td>
                            {{ Str::upper($publication->author_lastname) }}, <br/>
                            {{ $publication->author_forename }}
                        </td>
                        <td class="!text-wrap">{{
                                $publication->subtitle ?
                                $publication->title . ': ' . $publication->subtitle :
                                $publication->title
                            }}</td>
                        <td>{{ $publication->year }}</td>
                        <td>{{ $publication->type }}</td>
                        <td>{{ $publication->repository }}</td>
                        <td>
                            @foreach ($publication->searched_terms as $term)
                                {{ $term }}
                                @if (!$loop->last) + @endif
                            @endforeach
                        </td>
                        <td>{{ $publication->institution }}</td>
                        <td>{{ $publication->program }}</td>
                        <td>{{ $publication->city }}</td>
                        <td>{{ $publication->state->abbreviation ?? '' }}</td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
    </x-ts-card>
</section>
