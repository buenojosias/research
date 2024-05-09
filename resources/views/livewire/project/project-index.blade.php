<div>
    <div class="header">
        <h1>Projetos</h1>
        <x-ts-button text="Novo projeto" x-on:click="$wire.dispatch('open-form-modal')" />
    </div>

    <x-table>
        <x-slot name="header">
            <th>Data</th>
            <th>Tema</th>
            <th>Estudante</th>
            @if (auth()->user()->admin)
                <th>Usuário</th>
            @endif
            <th width="1"></th>
        </x-slot>
        <x-slot name="body">
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->requested_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('project.show', $project) }}">{{ $project->theme }}</a>
                    </td>
                    <td>{{ $project->student->name ?? '' }}</td>
                    @if (auth()->user()->admin)
                        <td>{{ $project->user->name }}</td>
                    @endif
                    <td class="flex space-x-2">
                        @if ($project->bibliometric_count > 0)
                            <x-ts-link :href="route('project.bibliometrics.show', $project)" icon="book-open" />
                        @else
                            <x-ts-icon name="book-open" class="h-4" color="gray" />
                        @endif
                        {{-- <x-ts-link href="#" icon="microphone" /> --}}
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
    @livewire('project.project-form')
</div>
