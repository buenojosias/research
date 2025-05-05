<div>
    <x-ts-modal title="Tags da produção" persistent wire size="sm" center>
        @forelse ($tags as $tag)
            <div class="flex justify-between items-center border-b py-1">
                <p>
                    {{ $tag->name }}
                </p>
            </div>
        @empty
            <p class="text-center text-sm font-semibold">Nenhuma tag adicionada.</p>
        @endforelse
        {{-- <x-slot:footer>
            <x-ts-button text="Gerenciar" :href="route('project.bibliometrics.productions.tags', [$production['project'], $production])" class="w-full" flat />
        </x-slot:footer> --}}
    </x-ts-modal>
</div>
