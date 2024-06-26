<div>

    <x-ts-card id="full-content">
        @foreach ($productions as $type => $types)
            <div class="mt-1" x-data="{ show_type: true }">
                <div class="px-2 flex justify-between bg-primary-600">
                    <h1 class="text-2xl">
                        {{ $type }}
                        <small>({{ $types->count() }} {{ $types->count() > 1 ? 'resultados' : 'resultado' }})</small>
                    </h1>
                    <div class="flex items-center">
                        <x-ts-button sm icon="chevron-up" light x-on:click="show_type = !show_type" />
                    </div>
                </div>
                <div x-show="show_type" x-collapse.duration.500ms>
                    @foreach ($types->groupBy('year') as $year => $years)
                        <div x-data="{ show_year: true }">
                            <div class="px-2 mb-1 flex justify-between text-xl font-semibold bg-primary-400">
                                <h2>
                                    {{ $year }}
                                    <small>({{ $years->count() }}
                                        {{ $years->count() > 1 ? 'resultados' : 'resultado' }})</small>
                                </h2>
                                <div class="flex items-center">
                                    <x-ts-button sm icon="chevron-up" light x-on:click="show_year = !show_year" />
                                </div>
                            </div>
                            <div class="divide-y" x-show="show_year" x-collapse.duration.500ms>
                                @foreach ($years as $production)
                                    <div class="py-4 px-3 space-y-2">
                                        <h3 class="text-lg font-semibold">{{ $production->title }}</h3>
                                        <p class="w-full text-wrap">{{ $production->abstract->content ?? '' }}</p>
                                        <p class="text-gray-600">
                                            <span>Palavras-chave:</span>
                                            @foreach ($production->keywords->data as $kw)
                                                {{ $kw }}@if (!$loop->last); @endif
                                            @endforeach
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
        @endforeach
    </x-ts-card>
</div>
