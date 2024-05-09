<section>
    <x-ts-toast />
    <div class="header">
        <div>
            <h1>Nova publicação</h1>
            <h2>{{ $research->theme }}</h2>
        </div>
    </div>

    <form wire:submit="save">
        <x-ts-card class="lg:grid grid-cols-6 gap-4 space-y-4 lg:space-y-0">
            <div class="col-span-4">
                <x-ts-input label="URL do resultado *" wire:model="url" />
            </div>
            <div class="col-span-2">
                <x-ts-select.styled label="Repositório *" wire:model="repository" :options="$research->repositories" />
            </div>
            <div class="col-span-3">
                <x-ts-input label="Título *" wire:model="title" />
            </div>
            <div class="col-span-3">
                <x-ts-input label="Subtítulo" wire:model="subtitle" />
            </div>
            <div class="">
                <x-ts-select.styled label="Ano *" wire:model="year" :options="$years" />
            </div>
            <div class="col-span-3">
                <x-ts-input label="Autor *" wire:model="author_forename" placeholder="Exceto último nome" />
            </div>
            <div class="col-span-2">
                <x-ts-input label="Autor (último nome) *" wire:model="author_lastname" />
            </div>
            <div class="col-span-2">
                <x-ts-select.styled label="Tipo *" wire:model="type" :options="$research->types" />
            </div>
            <div>
                <x-ts-select.styled label="Idioma *" wire:model="language" :options="$research->languages" />
            </div>
            <div class="col-span-3">
                <x-ts-select.styled label="Termos pesquisados *" wire:model="searched_terms" :options="$research->terms"
                    multiple />
            </div>

            @if (in_array('Tese', $research->types) ||
                    in_array('Dissertação', $research->types) ||
                    in_array('Artigo científico', $research->types))
                <div class="col-span-3">
                    <x-ts-input label="Instituição (universidade)" wire:model="institution" />
                </div>
                <div class="col-span-3">
                    <x-ts-input label="Programa" wire:model="program" />
                </div>
            @endif

            @if (in_array('Periódico', $research->types))
                <div class="col-span-3">
                    <x-ts-input label="Periódico" wire:model="periodical" />
                </div>
                <div class="col-span-3">
                    <x-ts-input label="DOI" wire:model="doi" />
                </div>
            @endif

            <div class="col-span-2">
                <x-ts-input label="Cidade" wire:model="city" />
            </div>
            <div class="">
                <x-ts-select.styled label="UF" wire:model="state_id" :options="$states"
                    select="label:abbreviation|value:id" searchable />
            </div>

            <div class="col-span-6 pt-4 mt-2 border-t">
                <x-ts-input label="Palavras-chave" wire:model="keywords"
                    hint="Separe usando vírgula, ponto ou ponto e vírgula." />
            </div>

            <x-slot:footer>
                <x-ts-button type="button" x-on:click="$modalOpen('modal-abstract')" text="Adicionar resumo" outline />
                <x-ts-button type="submit" text="Salvar" />
            </x-slot:footer>
        </x-ts-card>
    </form>

    <x-ts-modal title="Resumo da publicação" id="modal-abstract" size="4xl" x-on:close="info()">
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
