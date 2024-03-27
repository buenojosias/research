@props(['section', 'content'])

<div>
    @if ($content !== 'empty')
        {{ $content->content }}
    @else
        Você ainda não adicionou o {{ $section === 'abstract' ? 'resumo' : 'texto completo' }} desta publicação.
    @endif
</div>

<div class="pt-4 mt-4 border-t">
    @if ($content === 'empty')
        <x-ts-dropdown>
            <x-slot:action>
                <x-ts-button x-on:click="show = !show" sm>
                    Adicionar {{ $section === 'abstract' ? 'resumo' : 'texto completo' }}
                </x-ts-button>
            </x-slot:action>
            <div class="px-4 py-2 text-sm">Como você deseja adicionar?</div>
            <x-ts-dropdown.items text="Manualmente (copiar/colar)" separator />
            <x-ts-dropdown.items text="Extrair do PDF" />
        </x-ts-dropdown>
    @endif
</div>
