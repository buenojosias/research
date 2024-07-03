<div>
    <x-page-header title="Dashboard" subtitle="Research" />
    <div class="flex gap-6">
        <div class="w-1/2 space-y-4">
            <x-ts-card header="Meus projetos">
                @foreach ($projects as $project)
                <div class="py-2 border-b">
                    <x-ts-link href="{{ route('project.show', $project) }}" wire:navigate :text="$project->theme" />
                </div>
                @endforeach
            </x-ts-card>

            <x-table label="Meus projetos">
                <x-slot name="body">
                    @foreach ($projects as $project)
                        <tr>
                            <td>
                                <a href="{{ route('project.show', $project) }}" wire:navigate>{{ $project->theme }}</a>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>

        </div>
        <div class="w-1/2 space-y-4">
            <x-ts-card header="Estudantes">
                @foreach ($students as $student)
                <div class="py-2 border-b">
                    <x-ts-link href="#" wire:navigate :text="$student->name" />
                </div>
                @endforeach
            </x-ts-card>

            <x-table label="Estudantes">
                <x-slot name="body">
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                <a href="#" wire:navigate>{{ $student->name }}</a>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>


        </div>
    </div>

</div>
