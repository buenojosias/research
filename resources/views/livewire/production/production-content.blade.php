<section>
    <x-ts-toast />
    <div class="header">
        <div>
            <h1>Conteúdo da publicação</h1>
            <h2>{{ $publication->title }}</h2>
        </div>
        <div>
            <x-ts-link :href="route('researches.publications.show', [$research, $publication])" wire:navigate text="Voltar para pubicação" />
        </div>
    </div>

    <x-ts-tab wire:model.live="tab">
        <x-ts-tab.items tab="Palavras-chave">
            @if ($keywords)
                <ul class="divide-y divide-gray-100 lg:w-1/2">
                    @forelse ($keywords->data as $index => $keyword)
                        <li class="flex justify-between gap-x-6 py-2">
                            {{ $keyword }}
                            <x-ts-dropdown icon="ellipsis-vertical" static>
                                <x-ts-dropdown.items icon="pencil-square" text="Buscar palavra-chave" />
                                <x-ts-dropdown.items icon="pencil-square" text="Editar" separator />
                                <x-ts-dropdown.items wire:click="deleteKeyword({{ $index }})" icon="trash" text="Excluir" separator />
                            </x-ts-dropdown>
                        </li>
                    @empty
                        Nenhuma palavra-chave adicionada.
                    @endforelse
                </ul>
            @endif
            <div class="pt-4 mt-4 border-t">
                <livewire:modals.keyword-modal :publication="$publication" :keywords="$keywords" />
            </div>
        </x-ts-tab.items>
        <x-ts-tab.items tab="Resumo">
            @if ($abstract)
                <x-internal-content section="abstract" :content="$abstract" :research="$research" :publication="$publication" />
            @else
                Carregando...
            @endif
        </x-ts-tab.items>
        <x-ts-tab.items tab="Texto completo">
            @if ($body)
                <x-internal-content section="body" :content="$body" :research="$research" :publication="$publication" />
            @else
                Carregando...
            @endif
        </x-ts-tab.items>
        <x-ts-tab.items tab="Títulos de seção">
            Em breve
        </x-ts-tab.items>
    </x-ts-tab>

</section>
