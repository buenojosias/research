<section>
    <x-page-header title="Produção" :subtitle="$production->title" />
    </div>
    @if (session('status'))
        <x-ts-alert :text="session('status')" color="teal" close />
    @endif
    <div class="flex gap-x-6">
        @include('includes.production-nav')
        <div class="lg:grid grid-cols-2 gap-x-4">
            <div class="mb-6">
                <x-ts-card>
                    <div class="detail">
                        <x-detail label="Título" :value="$production->title" />
                        @if ($production->subtitle)
                            <x-detail label="Subtítulo" :value="$production->subtitle" />
                        @endif
                        <x-detail label="Ano" :value="$production->year" />
                        <div>
                            <dl class="w-full">
                                <dt>Autor(es)</dt>
                                <dd>
                                    <ul>
                                        @foreach ($production->authors as $author)
                                            <li>
                                                {{ $author['lastname'] }},
                                                {{ $author['forename'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                        <x-detail label="Tipo" :value="$production->type" />
                        <x-detail label="Repositório" :value="$production->repository" />
                        <div>
                            <dl class="w-full">
                                <dt>Link do resultado</dt>
                                <dd class="w-full">
                                    <span class="break-words">{{ $production->url }}</span>
                                    @if ($production->url)
                                        <x-ts-link :href="$production->url" icon="arrow-top-right-on-square" lg blank />
                                    @else
                                        Nenhum link adicionado
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        {{-- <span class="break-words">{{ $production->url }}</span> --}}
                        {{-- <x-detail label="Link do resultado" :value="$production->url">
                        <x-ts-link :href="$production->url" icon="arrow-top-right-on-square" lg blank />
                    </x-detail> --}}
                        <x-detail label="Idioma" :value="$production->language" />
                        <x-detail label="Palavras pesquisadas" :value="$production->searched_terms" />
                        @if ($production->institution)
                            <x-detail label="Instituição" :value="$production->institution" />
                        @endif
                        @if ($production->program)
                            <x-detail label="Progama" :value="$production->program" />
                        @endif
                        @if ($production->city)
                            <x-detail label="Cidade" :value="$production->city . ' (' . @$production->state->abbreviation . ')'" />
                        @endif
                        @if ($production->type === 'periódico')
                            <x-detail label="Periódico" :value="$production->periodical" />
                            <x-detail label="DOI" :value="$production->doi" />
                        @endif
                    </div>
                    <div class="card-footer">
                        <x-ts-link :href="route('project.bibliometrics.productions.edit', [$project, $production])" wire:navigate text="Editar" />
                        <x-ts-link :href="route('project.bibliometrics.productions.index', $project)" wire:navigate text="Voltar para resultados" />
                    </div>
                </x-ts-card>
            </div>

            <div class="mb-6 space-y-6">
                <x-ts-card>
                    <div class="detail">
                        <div>
                            <dl>
                                <dt>Resumo</dt>
                                <p>{{ $production->abstract->content ?? 'Não adicionado' }}</p>
                            </dl>
                        </div>
                        <x-detail label="Palavras-chave" :value="$production->keywords->data ?? 'Não adicionado'">
                            {{-- <x-ts-link :href="route('projects.productions.abstract', [$project, $production])" icon="pencil-square" /> --}}
                        </x-detail>
                    </div>
                    <div class="card-footer">
                        {{-- <x-ts-link text="Ver mais" :href="route('projects.productions.content', [$project, $production])" wire:navigate /> --}}
                        {{-- <x-ts-link text="Editar resumo" :href="route('projects.productions.abstract', [$project, $production])" wire:navigate /> --}}
                        {{-- <x-ts-link text="Editar conteúdo" :href="route('projects.productions.body', [$project, $production])" wire:navigate /> --}}
                    </div>
                </x-ts-card>

                <x-ts-card header="Arquivo PDF">
                    <div class="flex items-center justify-between">
                        @if ($production->file)
                            <x-ts-link :href="route('project.bibliometrics.productions.files.show', [$project, $production])" :text="$production->file->filename" wire:navigate />
                            <x-ts-button icon="trash" color="red" />
                        @else
                            Nenhum arquivo adicionado
                            <x-ts-button text="Adicionar" />
                        @endif
                    </div>
                </x-ts-card>

                <x-ts-card>
                    <div class="pb-3 border-b">
                        <x-ts-link href="#" wire:navigate text="Ranking de palavras" />
                    </div>
                    <div class="pt-3">
                        <x-ts-link href="#" wire:navigate text="Frequência de palavras" />
                    </div>
                </x-ts-card>
            </div>
        </div>
    </div>

</section>
