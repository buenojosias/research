<div>
    <x-ts-dropdown icon="ellipsis-vertical" static>
        <x-ts-dropdown.items text="Selecionar todos" wire:click="$dispatch('select-all')" />
        <x-ts-dropdown.items text="Desmarcar todos" wire:click="$dispatch('unselect-all')" />
        <x-ts-dropdown.items text="Adicionar a grupo" wire:click="$dispatch('open-slide')" divide />
    </x-ts-dropdown>
    @livewire('group.attach-group', ['project' => $project])
</div>
