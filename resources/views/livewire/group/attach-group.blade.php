<x-ts-slide title="Adicionar produções ao grupo" wire lg persistent>
    <div class="space-y-3">
        <x-ts-errors />
        @foreach ($groups as $key => $group)
            <x-ts-radio wire:model="selectedGroup" name="group" :id="$key" :value="$group->id" invalidate>
                <x-slot:label start>
                    {{ $group->name }}
                    @if ($group->description)
                        <br />
                        <small>{{ $group->description }}</small>
                    @endif
                </x-slot:label>
            </x-ts-radio>
        @endforeach
        <x-ts-button text="Criar grupo" wire:click="$dispatch('open-modal')" />
    </div>
    <x-slot:footer class="flex justify-between gap-4">
        <div class="flex-1">
            <x-ts-input placeholder="Adicionar anotação" wire:model="note" class="w-full" />
        </div>
        <x-ts-button text="Salvar" wire:click="attachGroup" />
    </x-slot>
    @livewire('group.group-create', ['project' => $project])
</x-ts-slide>
