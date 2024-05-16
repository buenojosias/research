<div class="w-[220px]">
    <x-ts-card header="Navegação">
        <div class="flex flex-col space-y-2">
            <a href="{{ route('project.bibliometrics.productions.show', [$project, $production]) }}" wire:navigate>Sobre</a>
            <a href="{{ route('project.bibliometrics.productions.keywords', [$project, $production]) }}" wire:navigate>Palavras-chave</a>
            <a href="#" wire:navigate>Resumo</a>
            <hr>
            <a href="#" wire:navigate>Introdução</a>
            <a href="#" wire:navigate>Objetivos</a>
            <a href="#" wire:navigate>Metodologia</a>
            <a href="#" wire:navigate>Resultados</a>
            <a href="#" wire:navigate>Discussão</a>
            <a href="#" wire:navigate>Conclusões</a>
            <hr>
            <a href="{{ route('project.bibliometrics.productions.files.show', [$project, $production]) }}" wire:navigate>Arquivo</a>
            <a href="#" wire:navigate>Capítulos</a>
            <a href="#" wire:navigate>Referência</a>
        </div>
    </x-ts-card>
</div>
