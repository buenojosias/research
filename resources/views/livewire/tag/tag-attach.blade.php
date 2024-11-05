<x-ts-modal title="Vincular tag" persistent wire size="sm" center>
    @foreach ($tags as $tag)
        <x-ts-checkbox name="selectedTags[]" wire:model="selectedTags" :value="$tag->id" :id="$tag->id" :label="$tag->name" />
        @if ($tag->subtags)
            <div class="pl-4 mb-2">
                @foreach ($tag->subtags as $subtag)
                    <x-ts-checkbox name="selectedTags[]" wire:model="selectedTags" :value="$subtag->id" :id="$subtag->id" :label="$subtag->name" sm />
                @endforeach
            </div>
        @endif
    @endforeach

    <x-slot:footer>
        <x-ts-button text="Vincular" wire:click="submit" class="w-full" />
    </x-slot:footer>
</x-ts-modal>
