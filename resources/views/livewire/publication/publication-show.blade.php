<section>
    <div class="header">
        <div>
            <h1>{{ $publication->title }}</h1>
            <h2>{{ $research->title }}</h2>
        </div>
    </div>

    <div class="lg:grid grid-cols-5 gap-6">
        <div class="col-span-2 mb-6">
            <x-ts-card class="pt-4">
                <div class="detail p-4">
                    <x-detail label="Título" :value="$publication->title" />
                    @if ($publication->subtitle)
                        <x-detail label="Subtítulo" :value="$publication->subtitle" />
                    @endif
                    <x-detail label="Ano" :value="$publication->year" />
                    <x-detail label="Autor" :value="Str::upper($publication->author_lastname) . ', ' . $publication->author_forename" />
                    <x-detail label="Tipo" :value="$publication->type" />
                    <x-detail label="Repositório" :value="$publication->repository" />
                    <x-detail label="Link do resultado" :value="$publication->url">
                        <x-ts-link :href="$publication->url" icon="arrow-top-right-on-square" lg blank />
                    </x-detail>
                    <x-detail label="Idioma" :value="$publication->language" />
                    <x-detail label="Termos pesquisados" :value="$publication->searched_terms" />
                    @if ($publication->institution)
                        <x-detail label="Instituição" :value="$publication->institution" />
                    @endif
                    @if ($publication->program)
                        <x-detail label="Progama" :value="$publication->program" />
                    @endif
                    @if ($publication->city)
                        <x-detail label="Cidade" :value="$publication->city . ' (' . @$publication->state->abbreviation . ')'" />
                    @endif
                    @if ($publication->type === 'periódico')
                        <x-detail label="Periódico" :value="$publication->periodical" />
                        <x-detail label="DOI" :value="$publication->doi" />
                    @endif
                </div>
                <div class="card-footer">
                    <x-ts-link href="#" wire:navigate text="Editar" />
                    <x-ts-link href="#" wire:navigate text="Voltar para pesquisa" />
                </div>
            </x-ts-card>
        </div>

        <div class="col-span-3 mb-6 space-y-6">
            <x-ts-card class="pt-4">
                <div class="detail p-4">
                    <div>
                        <dl>
                            <dt>Resumo</dt>
                            <p>{{ $publication->abstract->content ?? 'Não adicionado' }}</p>
                        </dl>
                        {{-- <div>
                            {{ $slot }}
                        </div> --}}
                    </div>
                    <x-detail label="Palavras-chave" :value="$publication->keywords->data">
                        <x-ts-link href="#" icon="pencil-square" />
                    </x-detail>
                </div>
                <div class="card-footer">
                    <x-ts-link href="#" wire:navigate text="Ver conteúdo completo" />
                </div>
            </x-ts-card>

            <x-ts-card>
                Arquivo
            </x-ts-card>

            <x-ts-card>
                <div class="p-4 border-b">
                    <x-ts-link href="#" wire:navigate text="Ranking de palavras" />
                </div>
                <div class="p-4 border-b">
                    <x-ts-link href="#" wire:navigate text="Frequência de palavras" />
                </div>
            </x-ts-card>
        </div>
    </div>
</section>
