<section>
    <div class="header">
        <h1>Pesquisas</h1>
        <x-ts-button text="Nova pesquisa" />
    </div>

    <x-ts-card>
        <x-table>
            <x-slot name="header">
                <th>Data</th>
                <th>Título</th>
                <th>Estudante</th>
                <th>Publicações</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($researches as $research)
                    <tr>
                        <td>{{ $research->requested_at->format('d/m//Y') }}</td>
                        <td>{{ $research->title }}</td>
                        <td>{{ $research->student->name ?? '' }}</td>
                        <td>{{ $research->publications_count }}</td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
    </x-ts-card>
</section>
