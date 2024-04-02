<div>
    <x-ts-button text="Adicionar palavra-chave" wire:click="$toggle('modal')" />
    <x-ts-modal title="Adicionar palavra-chave" size="sm" wire>
        <x-ts-input wire:model="input" label="Palavra-chave" hint="Insira apenas uma" />
        <x-slot:footer>
            <x-ts-button text="Salvar" wire:click="submit" />
        </x-slot:footer>
    </x-ts-modal>
</div>
