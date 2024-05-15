<section>
    <x-page-header title="Arquivos da bibliometria" :subtitle="$project->theme" />
    <div class="flex flex-wrap -mx-4">
        @forelse ($files as $file)
            <div class="w-full sm:w-1/2 lg:w-1/2 p-2">
                <x-ts-card class="h-full flex gap-4 items-center">
                    <div>
                        {{-- <a href="{{ route('researches.files.show', [$research, $file->publication]) }}">
                            <x-ts-icon name="document-text" class="h-8" outline />
                        </a> --}}
                    </div>
                    <div class="flex-1 space-y-2 overflow-hidden">
                        <div class="truncate max-w-full">
                            {{-- <a href="{{ route('researches.files.show', [$research, $file->publication]) }}">
                                {{ $file->path }}
                            </a> --}}
                        </div>
                        <div class="text-sm truncate max-w-full">
                            {{-- <a href="{{ route('researches.publications.show', [$research, $file->publication]) }}">
                                {{ $file->publication->author_lastname }} - {{ $file->publication->title }}
                            </a> --}}
                        </div>
                    </div>
                    <div>
                        <x-ts-dropdown icon="chevron-down" position="bottom-end">
                            {{-- <a href="{{ route('files', $file->path) }}" target="_blank">
                                <x-ts-dropdown.items text="Abrir arquivo" />
                            </a> --}}
                            {{-- <a href="{{ route('researches.publications.abstract', [$research, $file]) }}">
                                <x-ts-dropdown.items text="Extrair resumo" />
                            </a> --}}
                            {{-- <a href="{{ route('researches.publications.body', [$research, $file]) }}">
                                <x-ts-dropdown.items text="Extrair conteúdo" />
                            </a> --}}
                            <x-ts-dropdown.items class="items" text="Excluir" separator />
                        </x-ts-dropdown>
                    </div>
                    <x-slot:footer>
                        <div class="flex space-x-4 justify-between">
                            <div class="text-xs">
                                {{ $file->pages }} páginas
                            </div>
                            <div class="text-xs">
                                {{ number_format($file->size, 2, ',', '.') }} MB
                            </div>
                        </div>
                    </x-slot:footer>
                </x-ts-card>
            </div>
        @empty
            Nenhum arquivo adicionado
        @endforelse
    </div>
</section>
