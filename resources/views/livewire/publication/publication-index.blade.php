<section x-data="{
    author: false,
    year: true,
    type: true,
    repository: false,
    therms: false,
    periodical: false,
    institution: false,
    program: false,
    city: false,
    state: false,
}">
    <div class="header">
        <div>
            <h1>Publicações da pesquisa</h1>
            <h2>{{ $research->title }}</h2>
        </div>
        <x-ts-button text="Adicionar publicação" />
    </div>

    <x-ts-card id="scrollable" style="overflow-y: auto">
        <div class="card-header justify-between items-center">
            <div>
                <x-ts-input wire:model.live.debounce="q" placehoder="Buscar título ou subtítulo" icon="magnifying-glass" />
            </div>
            <div>
                <x-ts-button icon="funnel" outline x-on:click="$slideOpen('filters')" />
                <x-ts-button icon="eye" outline x-on:click="$slideOpen('columns')" />
            </div>
        </div>
        <x-table>
            <x-slot name="header">
                <th x-show="author">Autor</th>
                <th>Título</th>
                <th x-show="year">Ano</th>
                <th x-show="type">Tipo</th>
                <th x-show="repository">Repositório</th>
                <th x-show="therms">Termos pesquisados</th>
                <th x-show="periodical">Periódico</th>
                <th x-show="institution">Instituição</th>
                <th x-show="program">Programa</th>
                <th x-show="city">Cidade</th>
                <th x-show="state">UF</th>
            </x-slot>
            <x-slot name="body">
                @foreach ($publications as $publication)
                    <tr>
                        <td x-show="author">
                            {{ Str::upper($publication->author_lastname) }}, <br />
                            {{ $publication->author_forename }}
                        </td>
                        <td class="!text-wrap">
                            <a href="{{ route('researches.publications.show', [$research, $publication]) }}" wire:navigate>
                                {{ $publication->subtitle ? $publication->title . ': ' . $publication->subtitle : $publication->title }}
                            </a>
                        </td>
                        <td x-show="year">{{ $publication->year }}</td>
                        <td x-show="type">{{ $publication->type }}</td>
                        <td x-show="repository">{{ $publication->repository }}</td>
                        <td x-show="therms">
                            @foreach ($publication->searched_terms as $term)
                                {{ $term }}
                                @if (!$loop->last)
                                    +
                                @endif
                            @endforeach
                        </td>
                        <td x-show="periodical">{{ $publication->periodical }}</td>
                        <td x-show="institution">{{ $publication->institution }}</td>
                        <td x-show="program">{{ $publication->program }}</td>
                        <td x-show="city">{{ $publication->city }}</td>
                        <td x-show="state">{{ $publication->state->abbreviation ?? '' }}</td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
    </x-ts-card>

    <x-ts-slide left title="Filtros" id="filters" size="sm">
        <div class="space-y-3">
            <div class="flex flex-wrap gap-4">
                @for ($i = $research->start_year; $i <= $research->end_year; $i++)
                    <x-ts-checkbox name="anos[]" wire:model.live="anos" :value="$i" :label="$i" />
                @endfor
            </div>
            <x-ts-select.styled label="Repositório" wire:model.live="repo" placeholder="Selecione um repositório"
                :options="$research->repositories" />
            <x-ts-select.styled label="Tipo" wire:model.live="tipo" placeholder="Selecione um tipo"
                :options="$research->types" />
            <x-ts-select.styled label="Idioma" wire:model.live="idioma" placeholder="Selecione um idioma"
                :options="$research->languages" />
            @if ($has_monographies)
                <x-ts-select.styled label="Estado" wire:model.live="uf" placeholder="Selecione um estado"
                    :options="$states" />
                <x-ts-select.styled label="Região" wire:model.live="regiao" placeholder="Selecione uma região do país"
                    :options="$regions" />
            @endif
            @if ($has_periodicals)
                <x-ts-select.styled label="Periódico" wire:model.live="periodico" placeholder="Selecione um periódico"
                    :options="$periodicals" />
            @endif
        </div>
    </x-ts-slide>

    <x-ts-slide left title="Colunas visíveis" id="columns" size="sm">
        <div class="space-y-3">
            <x-ts-toggle x-model="author" label="Autor" />
            <x-ts-toggle x-model="year" label="Ano" />
            <x-ts-toggle x-model="type" label="Tipo" />
            <x-ts-toggle x-model="repository" label="Repositório" />
            <x-ts-toggle x-model="therms" label="Termos pesquisados" />
            @if ($has_periodicals)
                <x-ts-toggle x-model="periodical" label="Periódico" />
            @endif
            @if ($has_monographies)
                <x-ts-toggle x-model="institution" label="Instituição" />
                <x-ts-toggle x-model="program" label="Programa" />
                <x-ts-toggle x-model="city" label="Cidade" />
            @endif
            <x-ts-toggle x-model="state" label="Estado" />
        </div>
    </x-ts-slide>
</section>
@push('scripts')
    <script type="text/javascript">
        var scrollable = document.getElementById('scrollable');
        var y = scrollable.offsetTop;
        var doc = document.body;
        var body = document.body;
        var html = document.documentElement;
        var height = body.clientHeight;

        document.getElementById("scrollable").style.maxHeight = height - y - 16 + 'px';
        document.getElementById("scrollable").style.scrollbar = 'auto';
    </script>
@endpush
