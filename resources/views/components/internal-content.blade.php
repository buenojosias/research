@props(['section', 'content', 'research', 'publication'])

<div>
    @if ($content !== 'empty')
        {{ $content->content }}
    @else
        Você ainda não adicionou o {{ $section === 'abstract' ? 'resumo' : 'texto completo' }} desta publicação.
    @endif
</div>

<div class="pt-4 mt-4 border-t">

    @if ($content === 'empty')
        <x-ts-button :href="route('researches.publications.' . $section, [$research, $publication])">
            Adicionar {{ $section === 'abstract' ? 'resumo' : 'texto completo' }}
        </x-ts-button>
    @else
        <x-ts-button text="Editar" :href="route('researches.publications.' . $section, [$research, $publication])" />
    @endif

</div>
