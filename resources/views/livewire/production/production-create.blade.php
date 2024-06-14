<section>
    <x-ts-toast />
    <x-page-header title="Adicionar produção" :subtitle="$project->theme" />
    <form wire:submit="save" autocomplete="off">
        <x-ts-card class="lg:grid grid-cols-6 gap-4 space-y-4 lg:space-y-0">
            <div class="col-span-4">
                <x-ts-input label="URL do resultado" wire:model="url" />
            </div>
            <div class="col-span-2">
                <x-ts-select.styled label="Repositório *" wire:model="repository" :options="$bibliometric->repositories" />
            </div>
            <div class="col-span-3">
                <x-ts-input label="Título *" wire:model="title">
                    <x-slot:suffix>
                        <x-ts-button wire:click.prevent="titleToLower" icon="language" color="slate" outline />
                    </x-slot:suffix>
                </x-ts-input>
            </div>
            <div class="col-span-3">
                <x-ts-input label="Subtítulo" wire:model="subtitle">
                    <x-slot:suffix>
                        <x-ts-button wire:click.prevent="subtitleToLower" icon="language" color="slate" outline />
                    </x-slot:suffix>
                </x-ts-input>
            </div>
            <div class="col-span-2">
                <x-ts-select.styled label="Tipo *" wire:model="type" :options="$bibliometric->types" />
            </div>
            <div class="">
                <x-ts-select.styled label="Ano *" wire:model="year" :options="$years" />
            </div>
            <div class="col-span-3">
                <x-ts-input label="Autor(es) *" wire:model="authors_display" x-on:click="$modalOpen('authors-modal')"
                    readonly />
            </div>
            <div>
                <x-ts-select.styled label="Idioma *" wire:model="language" :options="$bibliometric->languages" />
            </div>
            <div class="col-span-3">
                <x-ts-select.styled label="Palavras pesquisadas *" wire:model="searched_terms" :options="$bibliometric->terms"
                    multiple />
            </div>

            @if (in_array('Tese', $bibliometric->types) ||
                    in_array('Dissertação', $bibliometric->types) ||
                    in_array('Artigo científico', $bibliometric->types))
                <div class="col-span-3">
                    <x-ts-input label="Instituição (universidade)" wire:model="institution" />
                </div>
                <div class="col-span-3">
                    <x-ts-input label="Programa" wire:model="program" />
                </div>
            @endif

            @if (in_array('Periódico', $bibliometric->types))
                <div class="col-span-3">
                    <x-ts-input label="Periódico" wire:model="periodical" />
                </div>
                <div class="col-span-3">
                    <x-ts-input label="DOI" wire:model="doi" />
                </div>
            @endif

            <div class="col-span-2">
                <x-ts-input label="Cidade" wire:model="city" autocomplete="off" />
            </div>
            <div class="">
                <x-ts-select.styled label="UF" wire:model="state_id" :options="$states"
                    select="label:abbreviation|value:id" searchable />
            </div>
            <div class="col-span-3"></div>

            <div class="col-span-3 pt-4 mt-2 border-t">
                <x-ts-input label="Palavras-chave" wire:model="keywords"
                    hint="Separe usando vírgula, ponto ou ponto e vírgula." />
            </div>

            <div class="col-span-3 pt-4 mt-2 border-t">
                <x-ts-input label="Resumo" wire:model="abstract" x-on:click="$modalOpen('modal-abstract')" readonly />
            </div>

            <x-slot:footer>
                {{-- <x-ts-button type="button" x-on:click="$modalOpen('modal-abstract')" text="Adicionar resumo" outline /> --}}
                <x-ts-button type="submit" text="Salvar" />
            </x-slot:footer>
        </x-ts-card>
    </form>
    <x-ts-modal id="authors-modal" size="xl" title="Autores">
        @foreach ($authors as $key => $author)
            <div class="flex border-b justify-between items-center py-1.5 px-1">
                <div>
                    {{ $author['lastname'] }},
                    {{ $author['forename'] }}
                </div>
                <div class="cursor-pointer">
                    <x-ts-icon name="trash" class="w-4" wire:click="removeAuthor({{ $key }})" />
                </div>
            </div>
        @endforeach
        <div class="mt-6 grid grid-cols-6 gap-4">
            <div class="col-span-4">
                <x-ts-input label="Adicionar autor(a)" wire:model="author.forename" placeholder="Exceto último nome" />
            </div>
            <div class="col-span-2 flex items-center">
                <x-ts-input label="Último nome" wire:model="author.lastname" />
                <div class="ml-2 mt-6 cursor-pointer">
                    <x-ts-icon name="check" class="w-4" wire:click="addAuthor" />
                </div>
            </div>
        </div>
    </x-ts-modal>
    <x-ts-modal title="Resumo da produção" id="modal-abstract" size="4xl" x-on:close="info()">
        <x-ts-textarea wire:model="abstract" rows="6" />
        <div class="card-footer">
            <x-ts-button text="OK" x-on:click="$modalClose('modal-abstract')" />
        </div>
    </x-ts-modal>
</section>
<script>
    info = () => $interaction('toast')
        .info('Resumo salvo', 'As alterações no resumo foram salvas.')
        .send();
</script>
