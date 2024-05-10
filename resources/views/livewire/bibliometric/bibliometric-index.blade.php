<section>
    <x-page-header title="Bibliometrias">

    </x-page-header>
    <div class="header">
        <h1>Pesquisas</h1>
        <x-ts-button text="Nova pesquisa" :href="route('researche.create')" wire:navigate />
    </div>

    <x-table>
        <x-slot name="header">
            <th>Data</th>
            <th>Tema</th>
            <th>Estudante</th>
            <th></th>
        </x-slot>
        <x-slot name="body">
            @foreach ($researches as $research)
                <tr>
                    <td>{{ $research->requested_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('researches.show', $research) }}">{{ $research->theme }}</a>
                    </td>
                    <td>{{ $research->student->name ?? '' }}</td>
                    <td>
                        <x-ts-link :href="route('researches.publications', $research)" wire:navigate :text="$research->publications_count . ' publicações'" />
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
</section>
