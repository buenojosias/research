<div>
    <x-page-header title="Dashboard" subtitle="Research" />

    <div class="sm:grid grid-cols-3 gap-4 space-y-2 sm:space-y-0 mb-6">
        <x-ts-stats title="Projetos" :number="$projects->count()" />
        <x-ts-stats title="Produções" :number="$projects->sum('productions_count')" />
    </div>

    <div class="sm:grid grid-cols-2 gap-4">
        <div class="space-y-4">
            <h2 class="text-lg font-semibold">Meus projetos</h2>
            @forelse ($projects as $project)
                <x-ts-card>
                    <x-ts-link :text="$project->theme" :href="route('project.show', $project)" color="black" />
                    <p class="mt-2 text-sm">{{ $project->productions_count }} produções</p>
                    <x-slot:footer>
                        <div class="space-x-4">
                            <x-ts-link text="Bibliometria" :href="route('project.bibliometrics.show', [$project])" />
                            <x-ts-link text="Produções" :href="route('project.bibliometrics.productions.index', [$project])" />
                        </div>
                    </x-slot>
                </x-ts-card>
            @empty
                Você ainda não possui projetos
            @endforelse
        </div>
    </div>


    <div class="hidden flex gap-6">
        <div class="w-ful sm:w-1/2 space-y-4">
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
        <div class="w-ful sm:w-1/2 space-y-4">
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
