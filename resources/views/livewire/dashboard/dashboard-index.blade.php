<div>
    <x-page-header title="Dashboard" subtitle="Research" />
    <div class="flex gap-6">
        <div class="w-1/2">
            <x-ts-card header="Meus projetos">
                @foreach ($projects as $project)
                <div class="py-2 border-b">
                    <x-ts-link href="{{ route('project.show', $project) }}" wire:navigate :text="$project->theme" />
                </div>
                @endforeach
            </x-ts-card>
        </div>
        <div class="w-1/2">
            <x-ts-card header="Estudantes">
                @foreach ($students as $student)
                <div class="py-2 border-b">
                    <x-ts-link href="#" wire:navigate :text="$student->name" />
                </div>
                @endforeach
            </x-ts-card>
        </div>
    </div>

</div>
