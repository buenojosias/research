<section>
    <x-ts-toast />
    <x-page-header :title="$production->title" />
    <div class="flex gap-x-6">
        @include('includes.production-nav')
        <div class="flex-1">
            @if (session('status'))
                <x-ts-alert :text="session('status')" color="teal" close />
            @endif
            <x-ts-card :header="$sectionLabel">
                @if ($content)
                    <x-internal-content :section="$section" :content="$content" :project="$project" :production="$production" />
                @else
                    Conteúdo ({{ Str::lower($sectionLabel) }}) não adicionado.
                    <div class="pt-4 mt-4 border-t">
                        <x-ts-button :href="route('project.bibliometrics.productions.section.form', [$project, $production, $section])" text="Adicionar conteúdo" />
                    </div>
                @endif
            </x-ts-card>
        </div>
    </div>
</section>
