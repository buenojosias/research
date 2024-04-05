    <x-ts-slide right title="Contexto do resultado" size="md" id="context" wire
        x-on:close="$wire.dispatch('close-slide')">
        <div class="divide-y">
        @foreach ($contexts as $context)
            <x-ts-card>
                {{ $context['before'] ?? '' }}
                <span class="font-bold">{{ $context['word'] }}</span>
                {{ $context['after'] ?? '' }}
            </x-ts-card>
        @endforeach
    </div>
    </x-ts-slide>
