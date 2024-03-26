<section>
    <div class="header">
        <div>
            <h1>Arquivo da publicação</h1>
            <h2>{{ $publication->title }}</h2>
        </div>
    </div>

    <div class="lg:grid grid-cols-6 gap-6">
        <div class="col-span-4">
            <x-ts-card>
                <object id="pdf-reader"
                    data="https://static.musixe.com/wp-content/uploads/2022/04/15160110/TECLADO-INICIANTE-MODULO-1.pdf#toolbar=1"
                    type="application/pdf" width="100%" height="100%" page="10">
                    <p>Unable to display PDF file. <a
                            href="/uploads/media/default/0001/01/540cb75550adf33f281f29132dddd14fded85bfc.pdf">Download</a>
                        instead.</p>
                </object>
            </x-ts-card>
        </div>

        <div class="col-span-2 mb-6 space-y-6">

            @if ($file)
            <x-ts-card class="pt-2" header="Detalhes do arquivo">
                <div class="detail p-4">
                    <x-detail label="Nome do arquivo" :value="$file->filename" />
                    <x-detail label="URL" :value="$file->path" />
                    <x-detail label="Tamanho" :value="$file->size . ' MB'" />
                    <x-detail label="Adicionado em" :value="$file->created_at->format('d/m/Y H:i:s')" />
                </div>
            </x-ts-card>
            @endif

            <div class="space-y-2">
                <x-ts-button text="Adicionar arquivo" color="white" class="w-full" lg />
                <x-ts-button text="Baixar arquivo" color="white" class="w-full" lg />
                <x-ts-button text="Excluir arquivo" color="white" class="w-full" lg />
                <x-ts-button text="Ver conteúdo interno" color="white" class="w-full" lg />
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script type="text/javascript">
        var scrollable = document.getElementById('pdf-reader');
        var y = scrollable.offsetTop;
        var doc = document.body;
        var body = document.body;
        var html = document.documentElement;
        var height = body.clientHeight;

        document.getElementById("pdf-reader").style.height = height - y - 32 + 'px';
        document.getElementById("pdf-reader").style.scrollbar = 'auto';
    </script>
@endpush
