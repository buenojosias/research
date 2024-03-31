<div>
    <x-ts-button text="Adicionar palavra-chave" x-on:click="$modalOpen('keyword-form')" />
    <x-ts-modal title="Adicionar palavra-chave" id="keyword-form" size="sm">
        <x-ts-input wire:model="input" label="Palavra-chave" hint="Insira apenas uma" />
        <x-slot:footer>
            <x-ts-button text="Salvar" wire:click="submit" />
        </x-slot:footer>
    </x-ts-modal>
</div>
