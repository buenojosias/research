<div>
    <x-ts-toast />
    <x-ts-dialog />
    <x-page-header title="Resultados das buscas">
        <x-ts-button text="Adicionar resultado" wire:click="$toggle('modal')" />
    </x-page-header>

    <div x-data="{ show: false }">
        <div class="table-header flex justify-between bg-white rounded">
            <div>Tabela detalhada</div>
            <div>
                <x-ts-button x-on:click="show = !show" icon="chevron-down" flat />
            </div>
        </div>
        <x-table x-show="show" x-collapse>
            <div x-show="false">
                <x-slot:header>
                    <th>Repositório</th>
                    <th>Palavras buscadas</th>
                    <th>Seções buscadas</th>
                    <th>Tipos</th>
                    <th>Idioma</th>
                    <th>Ano</th>
                    <th>Resultados</th>
                    <th></th>
                </x-slot>
                <x-slot:body>
                    @foreach ($results->sortBy('repository') as $result)
                        <tr>
                            <td>{{ $result->repository }}</td>
                            <td class="!text-wrap">
                                @foreach ($result->terms as $term)
                                    {{ $term }}
                                    @if (!$loop->last)
                                        AND
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($result->sections as $section)
                                    {{ $section }}
                                    @if (!$loop->last)
                                        /
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($result->types as $type)
                                    {{ $type }}
                                    @if (!$loop->last)
                                        /
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $result->language }}</td>
                            <td>{{ $result->year }}</td>
                            <td>{{ $result->quantity }}</td>
                            <td>
                                <x-ts-button icon="trash" wire:click="delete({{$result->id}})" color="red" sm flat />
                            </td>
                        </tr>
                    @endforeach
                </x-slot:body>
            </div>
        </x-table>
    </div>


    <div class="mt-6 sm:grid grid-cols-2 gap-6">
        @foreach ($results->groupBy('repository') as $repository => $items)
            <x-table :label="$repository" class="mb-6">
                <x-slot:header>
                    <th>Descritores</th>
                    <th>Seções buscadas</th>
                    <th>Tipos buscados</th>
                    <th>Ano</th>
                    <th>Resultados</th>
                </x-slot>
                <x-slot:body>
                    @foreach ($items as $result)
                        <tr>
                            <td class="!text-wrap">
                                @foreach ($result->terms as $term)
                                    {{ $term }}
                                    @if (!$loop->last)
                                        AND
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($result->sections as $section)
                                    {{ $section }}
                                    @if (!$loop->last)
                                        /
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($result->types as $type)
                                    {{ $type }}
                                    @if (!$loop->last)
                                        /
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $result->year ?? '---' }}</td>
                            <td>{{ $result->quantity }}</td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        @endforeach

        <x-table label="Lista por repositórios" class="mb-6">
            <x-slot name="header">
                <tr>
                    <th>Descritores</th>
                    @foreach ($repositories as $repository)
                        <th class="text-center">{{ $repository }}</th>
                    @endforeach
                    <th class="text-center">Total</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach ($tableByRepository as $word => $repositories)
                    <tr>
                        <td>{{ $word }}</td>
                        @foreach ($repositories as $repository)
                            <td class="text-center">{{ $repository ?? 0 }}</td>
                        @endforeach
                    </tr>
                @endforeach
                <tr>
                    <td class="font-semibold">Total</td>
                    @foreach ($repositories as $key => $repository)
                        <td class="text-center font-semibold">{{ $repositoryTotals[$key] }}</td>
                    @endforeach
                </tr>
            </x-slot>
        </x-table>

        <x-table label="Lista por anos" class="mb-6">
            <x-slot name="header">
                <tr>
                    <th>Descritores</th>
                    @foreach ($years as $year)
                        <th class="text-center">{{ $year }}</th>
                    @endforeach
                    <th class="text-center">Total</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach ($tableByYear as $word => $years)
                    <tr>
                        <td>{{ $word }}</td>
                        @foreach ($years as $year)
                            <td class="text-center">{{ $year ?? 0 }}</td>
                        @endforeach
                    </tr>
                @endforeach
                <tr>
                    <td class="font-semibold">Total</td>
                    @foreach ($years as $key => $year)
                        <td class="text-center font-semibold">{{ $yearTotals[$key] }}</td>
                    @endforeach
                </tr>
            </x-slot>
        </x-table>
    </div>

    <x-ts-modal title="Adicionar resultado" wire persistent>
        @if (session('success'))
            <x-ts-alert icon="check-circle" :text="session('success')" color="green" light close />
        @endif
        <form wire:submit="submit" id="result-form" class="sm:grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <x-ts-select.styled label="Repositório *" wire:model="repository" :options="$bibliometricRepositories" />
            </div>
            <div class="col-span-4">
                <x-ts-select.styled label="Palavra(s) buscada(s) *" wire:model="terms"
                    placeholder="Selecione uma ou mais opções" :options="$bibliometricTerms" multiple />
            </div>
            <div class="col-span-3">
                <x-ts-select.styled label="Tipo(s) buscado(s) *" wire:model="types"
                    placeholder="Selecione uma ou mais opções" :options="$bibliometricTypes" multiple />
            </div>
            <div class="col-span-3">
                <x-ts-select.styled label="Seções(s) buscada(s) *" wire:model="sections"
                    placeholder="Selecione uma ou mais opções" :options="$avaliableSections" multiple />
            </div>
            <div class="col-span-2">
                <x-ts-select.styled label="Idioma *" wire:model="language" :options="$bibliometricLanguages" />
            </div>
            <div class="col-span-2">
                <x-ts-select.styled label="Ano ponderado" wire:model="year" :options="$bibliometricYears" />
            </div>
            <div class="col-span-2">
                <x-ts-input label="Resultados *" wire:model="quantity" type="number" min="0" />
            </div>
        </form>
        <x-slot:footer>
            <x-ts-button type="submit" form="result-form" text="Adicionar" />
        </x-slot>
    </x-ts-modal>
</div>
