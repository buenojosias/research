<div class="sm:w-1/2 space-y-4">
    <x-table class="min-h-56">
        <x-slot name="body">
            @foreach ($keywords->data as $index => $keyword)
                <tr>
                    <td>{{ $keyword }}</td>
                    <td width="1">
                        <x-ts-dropdown icon="ellipsis-vertical" static>
                            <x-ts-dropdown.items icon="pencil-square" text="Buscar palavra-chave" />
                            <x-ts-dropdown.items icon="pencil-square" text="Editar" separator />
                            <x-ts-dropdown.items wire:click="deleteKeyword({{ $index }})" icon="trash"
                                text="Excluir" separator />
                        </x-ts-dropdown>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
    <livewire:modals.keyword-modal :production="$production" :keywords="$keywords" />
</div>
