@props(['section', 'content', 'project', 'production'])

<div>
    {{ $content->content }}
</div>

<div class="pt-4 mt-4 border-t">
    <x-ts-button :href="route('project.bibliometrics.productions.section.form', [$project, $production, $section])" text="Editar" />
</div>
