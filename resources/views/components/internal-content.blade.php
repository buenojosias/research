@props(['section', 'content', 'project', 'production'])

<div>
    @if ($content !== 'empty')
        {{ $content->content }}
    @else
        Você ainda não adicionou o {{ $section === 'abstract' ? 'resumo' : 'texto completo' }} desta publicação.
    @endif
</div>

<div class="pt-4 mt-4 border-t">

    @if ($content === 'empty')
        <x-ts-button :href="route('project.productions.' . $section, [$project, $production])">
            Adicionar {{ $section === 'abstract' ? 'resumo' : 'texto completo' }}
        </x-ts-button>
    @else
        <x-ts-button text="Editar" :href="route('project.productions.' . $section, [$project, $production])" />
    @endif

</div>
