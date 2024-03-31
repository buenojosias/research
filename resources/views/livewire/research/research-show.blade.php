<section>
    <div class="header">
        <div>
            <h1>{{ $research->theme }}</h1>
        </div>
    </div>
    @if (session('status'))
        <x-ts-alert :text="session('status')" color="green" close />
    @endif
    <div class="lg:grid grid-cols-5 gap-6">
        <div class="col-span-2 mb-6">
            <x-ts-card>
                <div class="detail">
                    <x-detail label="Data da solicitação" :value="$research->requested_at->format('d/m/Y')" />
                    @if ($research->student)
                        <x-detail label="Estudante" :value="$research->student->name" />
                    @endif
                    <x-detail label="Repositórios" :value="$research->repositories" />
                    <x-detail label="Tipos de publicação" :value="$research->types" />
                    <x-detail label="Termos" :value="$research->terms" />
                    <x-detail label="Combinações" :value="$research->combinations" />
                    <x-detail label="Intervalo de anos" :value="$research->period" />
                    <x-detail label="Idioma(s)" :value="$research->languages" />
                </div>
                <div class="card-footer">
                    <x-ts-link :href="route('researches.edit', $research)" wire:navigate>Editar</x-ts-link>
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
                    <x-ts-link :href="route('researches.publications', $research)" wire:navigate>Ver todas</x-ts-link>
                    <x-ts-link href="#">Adicionar nova</x-ts-link>
                @endslot
            </x-table>

            <x-ts-card>
                <div class="py-3 border-b">
                    <x-ts-link href="#" wire:navigate text="Ranking de palavras" />
                </div>
                <div class="py-3 border-b">
                    <x-ts-link href="#" wire:navigate text="Frequência de palavras" />
                </div>
            </x-ts-card>
        </div>
    </div>
</section>
