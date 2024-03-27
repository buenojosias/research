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
                    <x-ts-link :href="route('researches.show', $research)" wire:navigate text="Voltar para pesquisa" />
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
                    <x-detail label="Palavras-chave" :value="$publication->keywords->data ?? 'Não adicionado'">
                        <x-ts-link href="#" icon="pencil-square" />
                    </x-detail>
                </div>
                <div class="card-footer">
                    <x-ts-link :href="route('researches.publications.content', [$research, $publication])" wire:navigate wire:navigate text="Ver conteúdo completo" />
                </div>
            </x-ts-card>

            <x-ts-card header="Arquivo PDF">
                <div class="px-4 py-2 flex items-center justify-between">
                    @if ($publication->file)
                        <x-ts-link :href="route('researches.files.show', [$research, $publication])" :text="$publication->file->filename" wire:navigate />
                        <x-ts-button icon="trash" color="red" />
                    @else
                        Nenhum arquivo adicionado
                        <x-ts-button text="Adicionar" />
                    @endif
                </div>
            </x-ts-card>

            <x-ts-card class="px-4">
                <div class="py-3 border-b">
                    <x-ts-link href="#" wire:navigate text="Ranking de palavras" />
                </div>
                <div class="py-3 border-b">
                    <x-ts-link href="#" wire:navigate text="Frequência de palavras" />
                </div>
            </x-ts-card>
        </div>
    </div>
</section>
