<section>
    <x-page-header title="Estudante" :subtitle="$student->name" />
    <div class="lg:grid grid-cols-2 gap-6">
        <x-ts-card>
            <div class="detail">
                <x-detail label="Nome" :value="$student->name" />
                <x-detail label="E-mail" :value="$student->email ?? 'Não informado'" />
                <x-detail label="WhatsApp" :value="$student->whatsapp ?? 'Não informado'" />
                <x-detail label="Instituição" :value="$student->institution ?? 'Não informada'" />
                <x-detail label="Programa" :value="$student->program ?? 'Não informado'" />
                <x-detail label="Grau" :value="$student->degree ?? 'Não informado'" />
                <x-detail label="Orientador(a)" :value="$student->advisor ?? 'Não informado'" />
            </div>
            <x-slot:footer>
                <x-ts-button text="Editar" :href="route('students.edit', $student)" wire:navigate flat />
            </x-slot>
        </x-ts-card>
        <div>
            <x-table label="Projetos">
                <x-slot:body>
                    @forelse ($student->projects as $project)
                        <tr>
                            <td>
                                <a href="{{ route('project.show', $project) }}">{{ $project->theme }}</a>
                            </td>
                        </tr>
                    @empty
                        <div class="p-4 text-center text-sm">
                            Nenhum projeto para este(a) estudante.
                        </div>
                    @endforelse
                </x-slot:body>
            </x-table>
        </div>
    </div>
</section>
