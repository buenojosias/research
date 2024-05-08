<div>
    <div class="header">
        <div>
            <h1>Página inicial</h1>
            <h2>Research</h2>
        </div>
    </div>

    <div class="flex">
        <div class="w-1/2">
            <x-ts-card header="Meus projetos">
                @foreach ($projects as $project)
                <div class="py-2 border-b">
                    <x-ts-link href="#" wire:navigate :text="$project->theme" />
                </div>
                @endforeach
            </x-ts-card>
        </div>
    </div>

</div>
