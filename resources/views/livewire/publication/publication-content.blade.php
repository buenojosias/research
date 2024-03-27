<section>
    <div class="header">
        <div>
            <h1>Conteúdo da publicação</h1>
            <h2>{{ $publication->title }}</h2>
        </div>
    </div>

    <x-ts-tab wire:model.live="tab">
        <x-ts-tab.items tab="Palavras-chave">
            @if ($keywords)
                @foreach ($keywords->data as $keyword)
                    <x-ts-badge color="slate" outline>
                        <x-slot:right>
                            <x-ts-dropdown icon="ellipsis-vertical" static>
                                <x-ts-dropdown.items icon="pencil-square" text="Editar" />
                                <x-ts-dropdown.items icon="trash" text="Excluir" separator />
                            </x-ts-dropdown>
                        </x-slot:right>
                        {{ $keyword }}
                    </x-ts-badge>
                @endforeach
            @else
                Nenhuma palavra-chave adicionada.
            @endif
            <div class="pt-4 mt-4 border-t">
                <x-ts-button text="Adicionar palavra-chave" />
            </div>
        </x-ts-tab.items>
        <x-ts-tab.items tab="Resumo">
            @if ($abstract)
                <x-internal-content section="abstract" :content="$abstract" />
            @else
                Carregando...
            @endif
        </x-ts-tab.items>
        <x-ts-tab.items tab="Texto completo">
            @if ($body)
                <x-internal-content section="body" :content="$body" />
            @else
                Carregando...
            @endif
        </x-ts-tab.items>
    </x-ts-tab>

</section>
