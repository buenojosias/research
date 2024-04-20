<section>
    <div class="header">
        <h1>Gerar ranking de palavras</h1>
    </div>

    <div class="lg:grid grid-cols-5 gap-6">
        <div class="col-span-2 mb-6">
            <x-ts-errors />
            <div class="px-4 py-2 flex justify-between items-center bg-white rounded-t">
                <div class="flex gap-2 items-center">
                    <x-ts-dropdown>
                        <x-slot:action>
                            <x-ts-button x-on:click="show = !show" sm outline>Tipos de publicação</x-ts-button>
                        </x-slot:action>
                        @foreach ($research->types as $type)
                            <x-ts-dropdown.items>
                                <x-ts-checkbox name="publication_types[]" wire:model="publication_types" :value="$type"
                                    :label="$type" invalidate />
                            </x-ts-dropdown.items>
                        @endforeach
                    </x-ts-dropdown>
                    <x-ts-dropdown>
                        <x-slot:action>
                            <x-ts-button x-on:click="show = !show" sm outline>Seções</x-ts-button>
                        </x-slot:action>
                        <x-ts-dropdown.items>
                            <x-ts-checkbox name="sections[]" wire:model="sections" value="abstract" label="Resumo"
                                invalidate />
                        </x-ts-dropdown.items>
                        <x-ts-dropdown.items>
                            <x-ts-checkbox name="sections[]" wire:model="sections" value="body"
                                label="Conteúdo textual" invalidate />
                        </x-ts-dropdown.items>
                    </x-ts-dropdown>
                    <x-ts-dropdown>
                        <x-slot:action>
                            <x-ts-button x-on:click="show = !show" sm outline>Limite</x-ts-button>
                        </x-slot:action>
                        <x-ts-dropdown.items class="items">
                            <x-ts-input wire:model="wordsLimit" />
                        </x-ts-dropdown.items>
                    </x-ts-dropdown>
                    <x-ts-button wire:click="generate" text="Gerar" />
                </div>
                @if ($results && count($results) > 0)
                    <div>
                        <x-ts-button wire:click="$toggle('savingModal')" text="Salvar resultado" />
                    </div>
                @endif
            </div>
            <x-table>
                <x-slot name="header">
                    <th>Palavra</th>
                    <th>Ocorrências</th>
                    <th>Publicações</th>
                    <th width="1"></th>
                </x-slot>
                <x-slot name="body">
                    @if ($results)
                        @foreach ($results as $word => $result)
                            <tr>
                                <td>{{ $word }}</td>
                                <td>{{ $result['count'] }}</td>
                                <td>{{ count($result['internals']) }}</td>
                                <td>
                                    <x-ts-dropdown text="Ações" position="bottom-end">
                                        <x-ts-dropdown.items text="Ver contexto" />
                                        <x-ts-dropdown.items wire:click="selectResult({{ $result['id'] }})"
                                            text="Listar publicações" />
                                        <x-ts-dropdown.items text="Exluir" separator />
                                    </x-ts-dropdown>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </x-slot>
            </x-table>
        </div>

        <div class="col-span-3">
            @if ($selectedResult)
                {{-- {{ $selectedResult }} --}}
                {{-- <livewire:word-ranking.word-ranking-publications :$selectedResult /> --}}
                {{ $foo }}
            @endif
        </div>
    </div>

    <x-ts-modal title="Salvar relatório" wire="savingModal" size="sm">
        <div class="space-y-4">
            <x-ts-input wire:model="title" label="Título do relatório" hint="Opcional" />
            <x-ts-textarea wire:model="description" label="Breve descrição" hint="Opcional" />
        </div>
        <x-slot:footer>
            <x-ts-button text="Confirmar" wire:click="save" />
        </x-slot:footer>
    </x-ts-modal>

    @if ($savedWordRanking)
        <x-ts-modal title="Relatório salvo com sucesso" wire="savedModal" size="sm">
            O que você deseja fazer agora?
            <div class="mt-4 flex flex-col space-y-2">
                <x-ts-button wire:click="clear" text="Gerar novo relatório" color="white" />
                <x-ts-button :href="route('researches.wordrankings.show', [$research, $savedWordRanking->id])" wire:navigate text="Ir para o relatório" color="white" />
                <x-ts-button :href="route('researches.wordrankings.index', [$research])" wire:navigate text="Voltar para lista" color="white" />
            </div>
        </x-ts-modal>
    @endif
</section>