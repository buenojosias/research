<section>
    <div class="header">
        <h1>Estudantes</h1>
        <x-ts-button md text="Novo" />
    </div>

    <x-ts-card>
        <x-table>
            <x-slot name="header">
                <th>Nome</th>
                <th>Usuário</th>
                <th>Pesquisas</th>
                <th></th>
            </x-slot>
            <x-slot name="body">
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->user->name }}</td>
                        <td><x-ts-link href="#" :text="$student->researches_count" color="copy" /></td>
                        <td width="1%">
                            <x-ts-link href="#" icon="chevron-right" color="copy" />
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
    </x-ts-card>
</section>
