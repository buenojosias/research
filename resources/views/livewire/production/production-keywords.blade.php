<section>
    <x-ts-toast />
    <x-page-header title="Palavras chave da produção" :subtitle="$production->title" />
    </div>
    @if (session('status'))
        <x-ts-alert :text="session('status')" color="teal" close />
    @endif
    <div class="flex gap-x-6">
        @include('includes.production-nav')
        <div class="flex-1">
            <x-table class="min-h-56 mb-4">
                <x-slot name="body">
                    @foreach ($keywords->data as $index => $keyword)
                        <tr>
                            <td>{{ $keyword }}</td>
                            <td width="1">
                                <x-ts-dropdown icon="ellipsis-vertical" static>
                                    <x-ts-dropdown.items icon="pencil-square" text="Buscar palavra-chave" />
                                    <x-ts-dropdown.items icon="pencil-square" text="Editar" separator />
                                    <x-ts-dropdown.items wire:click="deleteKeyword({{ $index }})" icon="trash" text="Excluir" separator />
                                </x-ts-dropdown>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
            <livewire:modals.keyword-modal :production="$production" :keywords="$keywords" />
        </div>
    </div>
</section>
