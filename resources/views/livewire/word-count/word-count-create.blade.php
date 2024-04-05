<section>
    <div class="header">
        <h1>Contagem de palavras</h1>
    </div>

    <x-ts-errors />
    <div class="px-4 py-2 flex justify-between items-center bg-white rounded-t">
        <div class="flex gap-2 items-center">
            <x-ts-input wire:model="word" placeholder="Palavra ou expressão" invalidate />
            <x-ts-dropdown>
                <x-slot:action>
                    <x-ts-button x-on:click="show = !show" sm outline>Definições</x-ts-button>
                </x-slot:action>
                <p class="p-2 font-semibold border-b text-sm text-gray-800">Tipos de publicação</p>
                @foreach ($research->types as $type)
                    <x-ts-dropdown.items>
                        <x-ts-checkbox name="publication_types[]" wire:model="publication_types" :value="$type"
                            :label="$type" invalidate />
                    </x-ts-dropdown.items>
                @endforeach
                <p class="p-2 font-semibold border-b text-sm text-gray-800">Seções</p>
                <x-ts-dropdown.items>
                    <x-ts-checkbox name="sections[]" wire:model="sections" value="abstract" label="Resumo" invalidate />
                </x-ts-dropdown.items>
                <x-ts-dropdown.items>
                    <x-ts-checkbox name="sections[]" wire:model="sections" value="body" label="Conteúdo textual"
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
            <th>Publicação</th>
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
                        <td>{{ $result->publication->title }}</td>
                        <td>{{ $result->publication->type }}</td>
                        <td>{{ $result->section === 'abstract' ? 'Resumo' : 'Seção textual' }}</td>
                        <td>{{ $result->count }}</td>
                        <td>{{ $result->percentage }}%</td>
                        <td>
                            <x-ts-button outline
                                wire:click="selectResult"
                                text="Ver contexto"
                                wire:click="loadContext({{ $result->id }}, '{{ $result->section }}')"
                            />
                        </td>
                    </tr>
                @endforeach
            @endif
        </x-slot>
    </x-table>

    @if ($content)
        <livewire:word-count.context :$content :$word />
    @endif

</section>
