<div class="w-[220px]">
    <x-ts-card header="Navegação">
        @if (!$production->trashed())
            <div class="flex flex-col space-y-2">
                <a href="{{ route('project.bibliometrics.productions.show', [$project, $production]) }}"
                    wire:navigate>Sobre</a>
                <a href="{{ route('project.bibliometrics.productions.keywords', [$project, $production]) }}"
                    wire:navigate>Palavras-chave</a>
                <a href="{{ route('project.bibliometrics.productions.tags', [$project, $production]) }}"
                    wire:navigate>Tags</a>
                <hr>
                {{-- @if ($production->type->value === 'Tese' || $production->type->value === 'Dissertação') --}}
                {{-- @if (in_array($production->type->value, ['Tese', 'Dissertação', 'Artigo científico'])) --}}
                <a href="{{ route('project.bibliometrics.productions.goals', [$project, $production]) }}"
                    wire:navigate>Objetivos</a>
                {{-- @endif --}}
                @foreach (\App\Enums\ProductionSectionEnum::cases() as $item)
                    <a href="{{ route('project.bibliometrics.productions.section', [$project, $production, $item]) }}"
                        wire:navigate>{{ $item->label() }}</a>
                @endforeach
                <hr>
                <a href="{{ route('project.bibliometrics.productions.files.show', [$project, $production]) }}"
                    wire:navigate>Arquivo</a>
                <a href="#" wire:navigate>Capítulos</a>
                <a href="{{ route('project.bibliometrics.productions.references', [$project, $production]) }}"
                    wire:navigate>Referências</a>
                <a href="{{ route('project.bibliometrics.productions.citations', [$project, $production]) }}"
                    wire:navigate>Citações</a>
            </div>
        @endif
    </x-ts-card>
</div>
