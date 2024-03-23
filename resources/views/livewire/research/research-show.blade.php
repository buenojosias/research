<section>
    <div class="header">
        <div>
            <h1>{{ $research->title }}</h1>
        </div>
    </div>

    <div class="lg:grid grid-cols-5 gap-6">
        <div class="col-span-2 mb-6">
            <x-ts-card class="pt-4">
                <div class="detail px-4">
                    <x-detail label="Data da solicitação" :value="$research->requested_at->format('d/m/Y')" />
                    @if ($research->student)
                        <x-detail label="Estudante" :value="$research->student->name" />
                    @endif
                    <x-detail label="Repositórios" :value="$research->repositories" />
                    <x-detail label="Tipos" :value="$research->types" />
                    <x-detail label="Termos" :value="$research->terms" />
                    <x-detail label="Combinações" :value="$research->combinations" />
                    <x-detail label="Intervalo de anos" :value="$research->period" />
                    <x-detail label="Idioma(s)" :value="$research->languages" />
                </div>
                <div class="card-footer">
                    <x-ts-link href="#">Editar</x-ts-link>
                </div>
            </x-ts-card>
        </div>

        <div class="col-span-3 space-y-6">
            <x-ts-card>
                <h3 class="p-4">Publicações</h3>
                <x-table>
                    @slot('header')
                        <th>Título</th>
                        <th>Ano</th>
                    @endslot
                    @slot('body')
                        @foreach ($publications as $publication)
                            <tr>
                                <td>{{ $publication->title }}</td>
                                <td>{{ $publication->year }}</td>
                            </tr>
                        @endforeach
                    @endslot
                </x-table>
                <div class="card-footer">
                    <x-ts-link :href="route('researches.publications', $research)" wire:navigate>Ver todas</x-ts-link>
                    <x-ts-link href="#">Adicionar nova</x-ts-link>
                </div>
            </x-ts-card>

            <x-ts-card>
                <h3 class="p-4">Quantidade de publicações por tipo</h3>
                <x-table>
                    @slot('header')
                        <th>Tipo</th>
                        <th>Quantidade</th>
                    @endslot
                    @slot('body')
                        @foreach ($types as $type)
                            <tr>
                                <td>{{ $type->type }}</td>
                                <td>{{ $type->count }}</td>
                            </tr>
                        @endforeach
                    @endslot
                </x-table>
                <div class="card-footer">
                    <x-ts-link :href="route('researches.publications', $research)" wire:navigate>Ver todas</x-ts-link>
                    <x-ts-link href="#">Adicionar nova</x-ts-link>
                </div>
            </x-ts-card>
        </div>
    </div>

    <ol>
        <li>Estudante</li>
        <li>Botão Compartilhar</li>
        <li>Link para adicionar publicação</li>
        <li>Link para arquivos</li>
        <li>10 palavras mais citadas</li>
        <li>Link para ranking de palavras</li>
        <li>Link para contagem de palavras</li>
    </ol>
</section>
