<section>
    <x-ts-toast />
    <div class="header">
        <div>
            <h1>Arquivo da publicação</h1>
            <h2>{{ $publication->title }}</h2>
        </div>
    </div>

    <div class="lg:grid grid-cols-6 gap-6">
        <div class="col-span-4 pb-6 lg:pb-0">
            @if ($file)
                <div class="screen">
                    <object id="pdf-reader" data="{{ route('files', $path) }}#toolbar=1" type="application/pdf"
                        width="100%" height="100%" page="10">
                        <p>Unable to display PDF file. <a
                                href="{{ route('files', $path) }}">Download</a>
                            instead.</p>
                    </object>
                </div>
            @else
                <x-ts-card header="Nenhum arquivo adicionado.">
                    <livewire:file.upload :publication="$publication" />
                </x-ts-card>
            @endif
        </div>

        <div class="col-span-2 mb-6 space-y-6">

            @if ($file)
                <x-ts-card header="Detalhes do arquivo">
                    <div class="detail">
                        <x-detail label="Nome do arquivo" :value="$file->filename" />
                        <x-detail label="Páginas" :value="$file->pages" />
                        <x-detail label="URL" :value="route('files', $path)" />
                        <x-detail label="Tamanho" :value="number_format($file->size, 1, ',', '.') . ' MB'" />
                        <x-detail label="Adicionado em" :value="$file->created_at->format('d/m/Y H:i:s')" />
                    </div>
                </x-ts-card>
            @endif

            <div class="space-y-2">
                @if ($file)
                    <x-ts-button text="Extrair/editar conteúdo" :href="route('researches.publications.body', [$research, $publication])" color="white" class="w-full shadow"
                        lg />
                    <x-ts-button text="Conteúdo interno" :href="route('researches.publications.content', [$research, $publication])" wire:navigate color="white"
                        class="w-full shadow" lg />
                    <x-ts-button text="Baixar arquivo" color="white" class="w-full shadow" lg />
                    <x-ts-button text="Excluir arquivo" color="white" class="w-full shadow" lg />
                @endif
            </div>
        </div>
    </div>
</section>
