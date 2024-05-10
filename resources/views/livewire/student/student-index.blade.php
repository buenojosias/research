<section>
    <x-page-header title="Estudantes">
        <x-ts-button text="Novo" />
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
                    <td>{{ $student->name }}</td>
                    @if (auth()->user()->admin)
                        <td>{{ $student->user->name }}</td>
                    @endif
                    <td><x-ts-link href="#" :text="$student->projects_count" color="copy" /></td>
                    <td>
                        <x-ts-link href="#" icon="chevron-right" color="copy" />
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
</section>
