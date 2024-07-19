<section>
    <x-page-header title="Estudantes">
        <x-ts-button :href="route('students.create')" text="Novo" />
    </x-page-header>
    <x-table>
        <x-slot name="header">
            <th>Nome</th>
            @if (auth()->user()->admin)
                <th>Usuário</th>
            @endif
            <th>Projetos</th>
            <th width="1%"></th>
        </x-slot>
        <x-slot name="body">
            @foreach ($students as $student)
                <tr>
                    <td>
                        <a href="{{ route('students.show', $student) }}" wire:navigate>{{ $student->name }}</a>
                    </td>
                    @if (auth()->user()->admin)
                        <td>{{ $student->user->name }}</td>
                    @endif
                    <td><x-ts-link href="#" :text="$student->projects_count" color="copy" /></td>
                    <td>

                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
</section>
