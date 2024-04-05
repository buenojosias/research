<section x-data="{ showtable: false, showdetails: false }">
    <div class="header">
        <div>
            <h1>Contagem de palavras</h1>
            <h2></h2>
        </div>
    </div>
    <div class="lg:grid grid-cols-2 gap-6">
        <div class="mb-6">
            <x-ts-card>
                <div class="detail">
                    <x-detail label="Palavra ou expressão pesquisada" :value="$wordcount->word" />
                    <x-detail label="Tipos de publicação" :value="$wordcount->publication_types" />
                    <x-detail label="Seções pesquisadas" :value="$wordcount->sections" />
                    <x-detail label="Publicações encontrados" :value="count($wordcount->records)" />
                    <x-detail label="Data do relatório" :value="$wordcount->created_at->format('d/m/Y')" />
                </div>
                <div class="card-footer">
                    <div class="space-x-4 flex-1 flex">
                        <x-ts-toggle x-model="showtable" label="Mostrar tabela" />
                        <x-ts-toggle x-model="showdetails" label="Mostrar detalhes" />
                    </div>
                    <div>
                        <x-ts-button text="Excluir relatório" color="red" />
                    </div>
                </div>
            </x-ts-card>
        </div>

        <div x-show="showdetails" x-transition class="mb-6 space-y-4">
            <h2 class="mb-4 font-semibold">Publicações encontradas</h2>
            @foreach ($wordcount->records as $record)
                <x-ts-card x-data="{ details: false }">
                    <div @click="details = !details" class="card-header justify-between" :class="details ? 'pb-4 mb-2 border-b' : ''">
                        <div class="cursor-pointer">
                            {{ $record['publication']['author_lastname'] }},
                            {{ $record['publication']['year'] }}.
                            {{ $record['publication']['title'] }}
                        </div>
                        <div>
                            <x-ts-button color="white">
                                <x-ts-icon name="chevron-down" class="w-5" />
                            </x-ts-button>
                        </div>
                    </div>
                    <div class="detail" x-show="details" x-transition>
                        <x-detail label="Publicação" :value="$record['publication']['title']" />
                        <x-detail label="Tipo de publicação" :value="$record['publication']['type']" />
                        <x-detail label="Seção encontrada" :value="$record['section']" />
                        <x-detail label="Contagem de palavas" :value="$record['count'] .
                            ' / ' .
                            $record['total_words'] .
                            ' (' .
                            number_format($record['percentage'], 2, ',', '.') .
                            '%)'" />
                    </div>
                    <div class="card-footer" x-show="details" x-transition>
                        <div>
                            <x-ts-button
                                wire:click="loadContext({{ $record['internal_id'] }}, '{{ $record['section'] }}')"
                                text="Ver contexto" outline />
                            <x-ts-button :href="route('researches.publications.content', [
                                $research,
                                $record['publication']['id'],
                            ])" wire:navigate text="Ler conteúdo" outline />
                            <x-ts-button :href="route('researches.publications.show', [$research, $record['publication']['id']])" wire:navigate text="Abrir publicação" outline />
                        </div>
                    </div>
                </x-ts-card>
                {{-- @dump($record) --}}
            @endforeach
        </div>
    </div>

    <div x-show="showtable" x-transition>
        <x-table label="Publicações encontradas">
            <x-slot name="header">
                <th>Publicação</th>
                <th>Tipo</th>
                <th>Seção</th>
                <th>Contagem</th>
                <th>Percentual</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($records as $record)
                    <tr>
                        <td>{{ $record['publication']['title'] }}</td>
                        <td>{{ $record['publication']['type'] }}</td>
                        <td>{{ $record['section'] === 'abstract' ? 'Resumo' : 'Seção textual' }}</td>
                        <td>{{ $record['count'] }}</td>
                        <td>{{ $record['percentage'] }}%</td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
    </div>


    @if ($content)
        <livewire:word-count.word-count-context :$content :$word />
    @endif

</section>
