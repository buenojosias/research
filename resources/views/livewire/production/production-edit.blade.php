<section>
    <x-ts-toast />
    <x-page-header title="Adicionar produção" :subtitle="$production->title" />
    <form wire:submit="save">
        <x-ts-card class="lg:grid grid-cols-6 gap-4 space-y-4 lg:space-y-0">
            <div class="col-span-4">
                <x-ts-input label="URL do resultado" wire:model="url" />
            </div>
            <div class="col-span-2">
                <x-ts-select.styled label="Repositório *" wire:model="repository" :options="$bibliometric->repositories" />
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
                <x-ts-input label="Autor(es) *" wire:model="authors_display" x-on:click="$modalOpen('authors-modal')"
                    readonly />
            </div>
            {{-- <div class="col-span-3">
                <x-ts-input label="Autor *" wire:model="author_forename" placeholder="Exceto último nome" />
            </div>
            <div class="col-span-2">
                <x-ts-input label="Autor (último nome) *" wire:model="author_lastname" />
            </div> --}}
            <div class="col-span-2">
                <x-ts-select.styled label="Tipo *" wire:model="type" :options="$bibliometric->types" />
            </div>
            <div>
                <x-ts-select.styled label="Idioma *" wire:model="language" :options="$bibliometric->languages" />
            </div>
            <div class="col-span-3">
                <x-ts-select.styled label="Termos pesquisados *" wire:model="searched_terms" :options="$terms"
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
                <x-ts-input label="Cidade" wire:model="city" />
            </div>
            <div class="">
                <x-ts-select.styled label="UF" wire:model="state_id" :options="$states"
                    select="label:abbreviation|value:id" searchable />
            </div>

            <x-slot:footer>
                <x-ts-button type="button" :href="route('project.bibliometrics.productions.show', [$project, $production])" wire:navigate text="Ir para produção" outline />
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
</section>
