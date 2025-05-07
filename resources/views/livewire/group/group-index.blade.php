<div>
    <x-ts-toast />
    <x-ts-dialog />
    <x-page-header title="Grupos de produções" :subtitle="$project->theme">
        <div class="flex flex-col gap-4">
            <x-ts-button text="Criar grupo" wire:click="$dispatch('open-modal')" />
        </div>
    </x-page-header>

    <x-table>
        <x-slot name="header">
            <th>Nome/descrição</th>
            <th>Produções</th>
            <th width="80"></th>
        </x-slot>
        <x-slot name="body">
            @forelse ($this->groups as $group)
                <tr>
                    <td class="flex flex-col">
                        <a
                            href="{{ route('project.bibliometrics.productions.groups.show', [$project, $group]) }}">{{ $group->name }}</a>
                        <span class="text-sm text-gray-500">{{ $group->description }}</span>
                    </td>
                    <td>{{ $group->productions_count }}</td>
                    <td>
                        <x-ts-button icon="pencil" color="secondary" flat sm />
                        <x-ts-button icon="trash" color="red" flat sm />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500">
                        Nenhum grupo de produções criado neste projeto.
                    </td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>

    @livewire('group.group-create', ['project' => $project])
</div>
