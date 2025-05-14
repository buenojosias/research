<div>
    <x-ts-toast />
    <x-ts-dialog />
    <x-page-header title="Grupo de produções" :subtitle="$group->name">
        <div class="flex flex-col gap-1">
            <x-ts-button text="Adicionar produção" wire:click="$dispatch('open-slide')" />
            <x-ts-button text="Carregar resumos" wire:click="loadAbstract" />
        </div>
    </x-page-header>

    <x-table>
        @if ($group->description)
            <p class="p-4 text-sm text-gray-800">{{ $group->description }}</p>
        @endif
        <x-slot name="header">
            <th>Título</th>
            <th>Tipo</th>
            <th>Autor(es)</th>
            <th>Ano</th>
            <th>OBS</th>
            @if ($showAbstract)
                <th>Resumo</th>
            @endif
            <th width="40"></th>
        </x-slot>
        <x-slot name="body">
            @forelse ($this->groupProductions as $production)
                <tr>
                    <td class="!text-wrap">
                        {{ $production->full_title }}
                    </td>
                    <td>{{ $production->type }}</td>
                    <td class="!text-wrap">
                        @foreach ($production->authors as $author)
                            {{ $author->forename . ' ' . $author->lastname }}{!! !$loop->last ? ';<br>' : '' !!}
                        @endforeach
                    </td>
                    <td>{{ $production->year }}</td>
                    <td class="!text-wrap">{{ $production->pivot->note }}</td>
                    @if ($showAbstract)
                        <td class="!text-wrap">{{ $production->abstract->content ?? '' }}</td>
                    @endif
                    <td>
                        <x-ts-button icon="eye" :href="route('project.bibliometrics.productions.show', [$project, $production])" flat
                            sm />
                        <x-ts-button icon="link-slash" wire:click="detach({{ $production->id }})" color="red" flat
                            sm />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500">
                        Nenhuma produção adicionada ao grupo.
                    </td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>

    @livewire('group.attach-production', ['project' => $project, 'group' => $group, 'groupProductions' => $this->groupProductions])
</div>
