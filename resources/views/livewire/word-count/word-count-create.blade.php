<section>
    <x-page-header title="Contagem de palavras" />
    <x-ts-errors />
    <div class="px-4 py-2 flex justify-between items-center bg-white rounded-t">
        <div class="flex gap-2 items-center">
            <x-ts-input wire:model="word" placeholder="Palavra ou expressão" invalidate />
            <x-ts-dropdown>
                <x-slot:action>
                    <x-ts-button x-on:click="show = !show" sm outline>Definições</x-ts-button>
                </x-slot:action>
                <p class="p-2 font-semibold border-b text-sm text-gray-800">Tipos de produção</p>
                @foreach ($bibliometric->types as $type)
                    <x-ts-dropdown.items>
                        <x-ts-checkbox name="production_types[]" wire:model="production_types" :value="$type"
                            :label="$type" invalidate />
                    </x-ts-dropdown.items>
                @endforeach
                <p class="p-2 font-semibold border-b text-sm text-gray-800">Seções</p>
                <x-ts-dropdown.items>
                    <x-ts-checkbox name="sections[]" wire:model="sections" value="Resumo" label="Resumo" invalidate />
                </x-ts-dropdown.items>
                <x-ts-dropdown.items>
                    <x-ts-checkbox name="sections[]" wire:model="sections" value="Textual" label="Conteúdo textual"
                        invalidate />
                </x-ts-dropdown.items>
            </x-ts-dropdown>
            <x-ts-button wire:click="generate" text="Gerar" />
        </div>
        @if ($results && count($results) > 0)
            <div>
                <x-ts-button wire:click="save()" text="Salvar resultado" />
            </div>
        @endif
    </div>

    <x-table>
        <x-slot name="header">
            <th>Produção</th>
            <th>Tipo</th>
            <th>Seção</th>
            <th>Contagem</th>
            <th>Percentual</th>
            <th></th>
        </x-slot>
        <x-slot name="body">
            @if ($results)
                @foreach ($results as $result)
                    <tr>
                        <td>{{ $result->production->title }}</td>
                        <td>{{ $result->production->type }}</td>
                        <td>{{ $result->section->label() }}</td>
                        <td>{{ $result->count }} / {{ $result->total_words }}</td>
                        <td>{{ $result->percentage }}%</td>
                        <td>
                            <x-ts-button outline wire:click="selectResult" text="Ver contexto"
                                wire:click="loadContext({{ $result->id }}, '{{ $result->section }}')" />
                        </td>
                    </tr>
                @endforeach
            @endif
        </x-slot>
    </x-table>

    @if ($content)
        <livewire:word-count.word-count-context :$content :$word />
    @endif

    @if ($savedWordCount)
        <x-ts-modal title="Contagem salva com sucesso" wire="savedModal" size="sm">
            O que você deseja fazer agora?
            <div class="mt-4 flex flex-col space-y-2">
                <x-ts-button wire:click="$toggle('savedModal')" text="Fazer nova contagem" color="white" />
                <x-ts-button :href="route('project.bibliometrics.wordcounts.show', [$project, $savedWordCount->id])" wire:navigate text="Ir para contagem" color="white" />
                <x-ts-button :href="route('project.bibliometrics.wordcounts.index', [$project])" wire:navigate text="Voltar para lista" color="white" />
            </div>
        </x-ts-modal>
    @endif

</section>
