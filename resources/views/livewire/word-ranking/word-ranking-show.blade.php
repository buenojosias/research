<section>
    <x-page-header title="Ranking de palavras" />
    <div class="lg:grid grid-cols-5 gap-6">
        <div class="mb-6 col-span-2">
            <x-ts-card>
                <div class="detail">
                    @if ($wordranking->title)
                        <x-detail label="Título do relatório" :value="$wordranking->title" />
                    @endif
                    <x-detail label="Tipos de produção" :value="$wordranking->filters['production_types']" />
                    <x-detail label="Seções pesquisadas" :value="$wordranking->filters['internal_sections']" />
                    <x-detail label="Largura mínima das palavras" :value="$wordranking->filters['min_lenght']" />
                    <x-detail label="Limite de palavras" :value="$wordranking->words_limit" />
                    <x-detail label="Contagem total" :value="$totalCount" />
                    <x-detail label="Data do relatório" :value="$wordranking->created_at->format('d/m/Y')" />
                </div>
                {{-- <div class="card-footer">
                    <div class="space-x-4 flex-1 flex">
                        <x-ts-toggle x-model="showtable" label="Mostrar tabela" />
                        <x-ts-toggle x-model="showdetails" label="Mostrar detalhes" />
                    </div>
                    <div>
                        <x-ts-button text="Excluir relatório" color="red" />
                    </div>
                </div> --}}
            </x-ts-card>
        </div>

        <div class="col-span-3">
            <x-table label="Relatório">
                <x-slot name="header">
                    <th>Palavra</th>
                    <th>Ocorrências</th>
                    <th>Produções</th>
                    <th width="1"></th>
                </x-slot>
                <x-slot name="body">
                    @foreach ($wordranking->records as $record)
                        <tr>
                            <td>{{ $record['word'] }}</td>
                            <td>{{ $record['count'] }}</td>
                            <td>{{ $record['internal_count'] }}</td>
                            <td>
                                <x-ts-dropdown text="Ações" position="bottom-end">
                                    <x-ts-dropdown.items text="Ver contexto" />
                                </x-ts-dropdown>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
    </div>
</section>
