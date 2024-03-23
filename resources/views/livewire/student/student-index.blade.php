<section>
    <div class="header">
        <h1>Estudantes</h1>
        <x-ts-button text="Novo" />
    </div>

    <x-ts-card>
        <x-table :students=$students>
            <x-slot name="header">
                <th>Nome</th>
                <th>Usuário</th>
                <th>Pesquisas</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->researches_count }}</td>
                </tr>
            @endforeach
            </x-slot>
        </x-table>
    </x-ts-card>
</section>
