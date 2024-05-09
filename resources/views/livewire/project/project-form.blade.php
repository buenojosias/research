<x-ts-modal title="Novo projeto" size="sm" wire>
    <form class="space-y-4">
        <div>
            <x-ts-input wire:model="theme" label="Tema do projeto *" />
        </div>
        <div>
            <x-ts-date wire:model="requested_at" label="Data da solicitação *" :max-date="now()" />
        </div>
        <div>
            <x-ts-select.styled wire:model="student_id" label="Estudante pesquisador" hint="Opcional" placeholder="Selecione uma opção"
                :options="$students" select="label:name|value:id" />
        </div>
        <x-slot:footer>
            <x-ts-button type="submit" wire:click="save" text="Salvar" />
        </x-slot:footer>
    </form>
</x-ts-modal>
