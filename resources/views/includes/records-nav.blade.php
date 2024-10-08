<div class="w-[220px]">
    <x-ts-card header="Navegação">
        <div class="flex flex-col space-y-2">
            <a href="{{ route('project.bibliometrics.records.years', [$project]) }}" wire:navigate>Por ano</a>
            <a href="{{ route('project.bibliometrics.records.states', [$project]) }}" wire:navigate>Por estado</a>
            <a href="{{ route('project.bibliometrics.records.cities', [$project]) }}" wire:navigate>Por cidade</a>
            <a href="{{ route('project.bibliometrics.records.periodicals', [$project]) }}" wire:navigate>Por periódico</a>
            <a href="{{ route('project.bibliometrics.records.institutions', [$project]) }}" wire:navigate>Por instituição</a>
            <a href="{{ route('project.bibliometrics.records.programs', [$project]) }}" wire:navigate>Por programa</a>
            <a href="{{ route('project.bibliometrics.records.authors', [$project]) }}" wire:navigate>Por autor</a>
            <a href="{{ route('project.bibliometrics.records.descriptors', [$project]) }}" wire:navigate>Por descritores</a>
        </div>
    </x-ts-card>
</div>
