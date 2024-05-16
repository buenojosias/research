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
    <x-page-header title="Produções encontradas" :subtitle="$project->theme ">
        <x-ts-button text="Adicionar produção" :href="route('project.bibliometrics.productions.create', $project)" wire:navigate />
    </x-page-header>

    <x-table screen>
        <div class="table-header flex justify-between items-center">
            <div class="w-1/2">
                <x-ts-input wire:model.live.debounce="q" placehoder="Buscar título ou subtítulo" icon="magnifying-glass" />
            </div>
            <div>
                <x-ts-button icon="funnel" outline x-on:click="$slideOpen('filters')" />
                <x-ts-button icon="eye" outline x-on:click="$slideOpen('columns')" />
            </div>
        </div>
        <x-slot name="header">
            <th x-show="author">Autor(es)</th>
            <th>Título</th>
            <th x-show="year">Ano</th>
            <th x-show="type">Tipo</th>
            <th x-show="repository">Repositório</th>
            <th x-show="therms">Palavras buscadas</th>
            <th x-show="periodical">Periódico</th>
            <th x-show="institution">Instituição</th>
            <th x-show="program">Programa</th>
            <th x-show="city">Cidade</th>
            <th x-show="state">UF</th>
        </x-slot>
        <x-slot name="body">
            @foreach ($productions as $production)
                <tr>
                    <td x-show="author">
                        <ul>
                            @foreach ($production->authors as $author)
                                <li>
                                    {{ $author['lastname'] }}, {{ $author['forename'] }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="!text-wrap">
                        <a href="{{ route('project.bibliometrics.productions.show', [$project, $production]) }}" wire:navigate>
                            {{ $production->subtitle ? $production->title . ': ' . $production->subtitle : $production->title }}
                        </a>
                    </td>
                    <td x-show="year">{{ $production->year }}</td>
                    <td x-show="type">{{ $production->type }}</td>
                    <td x-show="repository">{{ $production->repository }}</td>
                    <td x-show="therms">
                        @foreach ($production->searched_terms as $term)
                            {{ $term }}
                            @if (!$loop->last)
                                +
                            @endif
                        @endforeach
                    </td>
                    <td x-show="periodical">{{ $production->periodical }}</td>
                    <td x-show="institution">{{ $production->institution }}</td>
                    <td x-show="program">{{ $production->program }}</td>
                    <td x-show="city">{{ $production->city }}</td>
                    <td x-show="state">{{ $production->state->abbreviation ?? '' }}</td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>

    <x-ts-slide left title="Filtros" id="filters" size="sm">
        <div class="space-y-3">
            <div class="flex flex-wrap gap-4">
                @for ($i = $bibliometric->start_year; $i <= $bibliometric->end_year; $i++)
                    <x-ts-checkbox name="anos[]" wire:model.live="anos" :value="$i" :label="$i" />
                @endfor
            </div>
            <x-ts-select.styled label="Repositório" wire:model.live="repo" placeholder="Selecione um repositório"
                :options="$bibliometric->repositories" />
            <x-ts-select.styled label="Tipo" wire:model.live="tipo" placeholder="Selecione um tipo"
                :options="$bibliometric->types" />
            <x-ts-select.styled label="Idioma" wire:model.live="idioma" placeholder="Selecione um idioma"
                :options="$bibliometric->languages" />
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
            <x-ts-toggle x-model="therms" label="Palavras buscadas" />
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
