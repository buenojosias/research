<div>
    <x-ts-button text="Adicionar palavra-chave" wire:click="$toggle('modal')" />
    <x-ts-modal title="Adicionar palavra-chave" size="sm" wire>
        <x-ts-input wire:model="input" label="Palavra-chave" hint="Separe com ponto e vírgula" />
        <x-slot:footer>
            <x-ts-button text="Salvar" wire:click="submit" />
        </x-slot:footer>
    </x-ts-modal>
</div>
