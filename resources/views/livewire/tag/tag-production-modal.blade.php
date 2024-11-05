<div>
    <x-ts-modal title="Tags da produção" persistent wire size="sm" center>
        @forelse ($tags as $tag)
            <div class="flex justify-between items-center border-b py-1">
                <p>
                    @if ($tag->parent)
                        <span class="text-gray-600">
                            {{ $tag->parent->name }} &rarr;
                        </span>
                    @endif
                    {{ $tag->name }}
                </p>
                <x-ts-button wire:click="detachTag({{ $tag }})" icon="trash"
                    color="red" sm flat />
            </div>
        @empty
            <p class="text-center text-sm font-semibold">Nenhuma tag adicionada.</p>
        @endforelse

        <x-slot:footer>
            <x-ts-button text="Adicionar tag"
                x-on:click="$dispatch('open-attach-modal', { production: {{ $production }} })" class="w-full" flat />
        </x-slot:footer>
    </x-ts-modal>
    @livewire('tag.tag-attach', ['production' => $production])
</div>
