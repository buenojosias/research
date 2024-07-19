<section>
    <x-ts-toast />
    <x-page-header :title="$student ? 'Editar estudante' : 'Adicionar estudante'" />
    <x-ts-errors />
    <form wire:submit="save">
        <x-ts-card class="lg:grid grid-cols-6 gap-4 lg:space-y-0">
            <div class="col-span-3">
                <x-ts-input wire:model="name" label="Nome *" />
            </div>
            <div class="col-span-3">
                <x-ts-input wire:model="email" label="E-mail" />
            </div>
            <div class="col-span-3">
                <x-ts-input wire:model="whatsapp" label="WhatsApp" x-mask="(99) 99999-9999" />
            </div>
            <div class="col-span-3">
                <x-ts-input wire:model="institution" label="Instituição" />
            </div>
            <div class="col-span-3">
                <x-ts-input wire:model="program" label="Programa" />
            </div>
            <div class="col-span-3">
                <x-ts-select.styled wire:model="degree" label="Grau" :options="App\Enums\DegreeEnum::cases()" />
            </div>
            <div class="col-span-3">
                <x-ts-input wire:model="advisor" label="Orientador(a)" />
            </div>
            <x-slot:footer>
                @if ($student)
                    <x-ts-button type="button" :href="route('students.show', $student)" wire:navigate text="Ir para ficha" flat />
                @endif
                <x-ts-button type="submit" text="Salvar" />
            </x-slot:footer>
        </x-ts-card>
    </form>
</section>
