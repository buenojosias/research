<div class="w-[220px]">
    <x-ts-card header="Navegação">
        <div class="flex flex-col space-y-2">
            <a href="{{ route('project.bibliometrics.productions.show', [$project, $production]) }}" wire:navigate>Sobre</a>
            <a href="{{ route('project.bibliometrics.productions.keywords', [$project, $production]) }}" wire:navigate>Palavras-chave</a>
            <hr>
            @foreach (\App\Enums\ProductionSectionEnum::cases() as $item)
                <a href="{{ route('project.bibliometrics.productions.section', [$project, $production, $item]) }}" wire:navigate>{{ $item->label() }}</a>
            @endforeach
            <hr>
            <a href="{{ route('project.bibliometrics.productions.files.show', [$project, $production]) }}" wire:navigate>Arquivo</a>
            <a href="#" wire:navigate>Capítulos</a>
            <a href="#" wire:navigate>Referências</a>
        </div>
    </x-ts-card>
</div>
