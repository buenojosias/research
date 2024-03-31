<section>
    <div class="header">
        <div>
            <h1>{{ $research ? 'Editar' : 'Nova' }} pesquisa</h1>
        </div>
    </div>
    <form wire:submit="save">
        <x-ts-card class="lg:grid grid-cols-6 gap-4">
            <div class="col-span-3">
                <x-ts-select.styled wire:model="student_id" label="Estudante pesquisador" placeholder="Selecione uma opção"
                    :options="$students" select="label:name|value:id" />
            </div>
            <div class="col-span-3">
                <x-ts-input wire:model="theme" label="Tema da pesquisa *" />
            </div>
            <div class="col-span-3">
                <x-ts-tag wire:model="repositories" label="Repositórios *" hint="Separe os itens com vírgula" />
            </div>
            <div class="col-span-3">
                <x-ts-select.styled wire:model="types" label="Tipos de publicação" placeholder="Selecione as opções"
                    :options="$avaliable_types" multiple />
            </div>
            <div class="col-span-6">
                <x-ts-tag wire:model="terms" label="Termos para pesquisar *" hint="Separe os itens com vírgula" />
            </div>
            <div class="col-span-3">
                <x-ts-tag wire:model="combinations" label="Combinações *" hint="Ex: A+B, A+C, B+C" />
            </div>
            <div class="col-span-3">
                <x-ts-tag wire:model="languages" label="Idiomas *" hint="Separe os itens com vírgula" />
            </div>
            <div class="col-span-2">
                <x-ts-number wire:model.blur="start_year" label="Ano inicial *" min="2000" />
            </div>
            <div class="col-span-2">
                <x-ts-number wire:model="end_year" label="Ano final *" />
            </div>
            <div class="col-span-2">
                <x-ts-date wire:model="requested_at" label="Data da solicitação *" :max-date="now()" />
            </div>
            <x-slot:footer>
                <x-ts-button type="submit" text="Salvar" />
            </x-slot:footer>
        </x-ts-card>
    </form>
</section>
