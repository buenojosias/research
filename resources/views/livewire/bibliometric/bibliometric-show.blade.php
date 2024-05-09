<section>
    <div class="header">
        <div>
            <h1>Bibliometria</h1>
            <h2>{{ $project->theme }}</h2>
        </div>
    </div>
    @if (session('status'))
        <x-ts-alert :text="session('status')" color="teal" close />
    @endif
    <div class="lg:grid grid-cols-5 gap-6">
        <div class="col-span-2 mb-6">
            <x-ts-card>
                <div class="detail">
                    <x-detail label="Data da solicitação" :value="$project->requested_at->format('d/m/Y')" />
                    <x-detail label="Repositórios" :value="$bibliometric->repositories" />
                    <x-detail label="Tipos de publicação" :value="$bibliometric->types" />
                    <x-detail label="Termos" :value="$bibliometric->terms" />
                    <x-detail label="Combinações" :value="$bibliometric->combinations" />
                    <x-detail label="Intervalo de anos" :value="$bibliometric->period" />
                    <x-detail label="Idioma(s)" :value="$bibliometric->languages" />
                </div>
                <div class="card-footer">
                    {{-- <x-ts-link :href="route('researches.edit', $research)" wire:navigate>Editar</x-ts-link> --}}
                </div>
            </x-ts-card>
        </div>

        <div class="col-span-3 space-y-6">
            <x-table class="no-padding" label="Publicações">
                @slot('header')
                    <th>Tipo</th>
                    <th>Quantidade</th>
                @endslot
                @slot('body')
                    @foreach ($types as $type)
                        <tr>
                            <td>{{ $type->type }}</td>
                            <td>{{ $type->count }}</td>
                        </tr>
                    @endforeach
                @endslot
                @slot('footer')
                    {{-- <x-ts-link :href="route('researches.publications', $research)" wire:navigate>Ver todas</x-ts-link> --}}
                    {{-- <x-ts-link :href="route('researches.publications.create', $research)" wire:navigate>Adicionar nova</x-ts-link> --}}
                @endslot
            </x-table>

            <x-ts-card>
                <div class="pb-3 border-b">
                    <x-ts-link href="#" wire:navigate text="Ranking de palavras" />
                </div>
                <div class="pt-3">
                    <x-ts-link href="#" wire:navigate text="Frequência de palavras" />
                </div>
            </x-ts-card>
        </div>
    </div>
</section>
