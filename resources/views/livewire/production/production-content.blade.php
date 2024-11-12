<div class="flex-1 flex gap-x-6">
    @if (session('status'))
        <x-ts-alert :text="session('status')" color="teal" close />
    @endif
    <div class="w-full">
        <x-ts-card :header="$sectionLabel">
            @if ($content)
                <x-internal-content :section="$section" :content="$content" :project="$project" :production="$production" />
            @else
                Conteúdo ({{ Str::lower($sectionLabel) }}) não adicionado.
                <div class="pt-4 mt-4 border-t">
                    <x-ts-button :href="route('project.bibliometrics.productions.section.form', [
                        $project,
                        $production,
                        $section,
                    ])" text="Adicionar conteúdo" />
                </div>
            @endif
        </x-ts-card>
        <div class="pt-4">
            <x-ts-button text="Vincular tag"
                x-on:click="$dispatch('open-attach-modal', { production: {{ $production->id }} })" />
        </div>
    </div>
    @livewire('tag.tag-attach', ['production' => $production])
</div>
