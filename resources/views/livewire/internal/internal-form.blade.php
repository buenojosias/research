<section x-data="{ file: false, tools: false }">
    <x-ts-toast />
    <div class="header">
        <div>
            <h1>{{ $section == 'abstract' ? 'Resumo' : 'Conteúdo completo' }} da publicação</h1>
            <h2>{{ $publication->title }}</h2>
        </div>
        <div>
            <x-ts-button text="Extrair do arquivo" x-show="file" @click="tools = !tools" outline />
            <x-ts-button text="Exibir/ocultar arquivo" @click="file = !file" outline />
            <x-ts-button text="Salvar" wire:click="save" />
        </div>
    </div>

    <x-ts-errors close />
    <div class="flex flex-col lg:flex-row gap-6">
        <div class="sm:w-full lg:w-1/2 relative">
            <x-ts-textarea wire:model="content" class="screen" x-bind:class="tools ? 'pt-16' : ''" />
            <div x-show="tools && file" x-transition class="absolute top-1 rounded-t w-full px-4 py-2 bg-gray-600/70 flex items-center gap-4">
                <div class="w-24">
                    <x-ts-input placeholder="Pág. inicial" wire:model="first_page" invalidate />
                </div>
                <div class="w-24">
                    <x-ts-input placeholder="Página final" wire:model="last_page" invalidate />
                </div>
                <x-ts-button wire:click="extractText" text="Processar" />
                <x-ts-button icon="x-mark" @click="tools = false" color="white" outline />
            </div>
        </div>
        <div class="flex-1" x-show="file" x-transition>
            <object id="pdf-reader" data="{{ asset('uploads/teste.pdf') }}#toolbar=1" type="application/pdf"
                width="100%" class="screen">
                <p>Unable to display PDF file. <a
                        href="/uploads/media/default/0001/01/540cb75550adf33f281f29132dddd14fded85bfc.pdf">Download</a>
                    instead.</p>
            </object>
        </div>
    </div>

</section>
