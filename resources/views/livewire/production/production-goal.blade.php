<section>
    <x-ts-dialog />
    <x-ts-toast />
    <x-page-header :title="$production->title" />
    <div class="flex gap-x-6">
        @include('includes.production-nav')
        <div class="flex-1 space-y-6">
            @if (session('status'))
                <x-ts-alert :text="session('status')" color="teal" close />
            @endif
            <x-ts-card header="Objetivo geral" x-data="{ showTextarea: $wire.entangle('editingGeneral') }">
                <div x-show="showTextarea" x-collapse>
                    <x-ts-textarea wire:model="generalGoal" rows="2" placeholder="Adicionar objetivo específico" />
                </div>
                @if ($generalGoal)
                    <p x-show="!showTextarea" x-collapse>{{ $generalGoal }}</p>
                @else
                    <p x-show="!showTextarea" x-collapse>Conteúdo não adicionado.</p>
                @endif
                <div class="mt-4">
                    <x-ts-button x-show="!showTextarea" x-on:click="showTextarea = true" :text="$generalGoal ? 'Editar objetivo geral' : 'Adicionar objetivo geral'" />
                    <x-ts-button x-show="showTextarea" wire:click="saveGeneralGoal" text="Salvar" />
                    <x-ts-button x-show="showTextarea" x-on:click="showTextarea = false" color="white"
                        text="Cancelar" />
                </div>
            </x-ts-card>

            <x-ts-card header="Objetivos específicos" x-data="{ showTextarea: $wire.entangle('creatingSpecific') }">
                @forelse ($specificGoals as $goal)
                    <div class="flex justify-between items-center space-x-4 py-3 border-b">
                        <div class="flex-1">
                            <p>{{ $goal->content }}</p>
                            {{-- <div x-show="showTextarea" x-collapse>
                                <x-ts-textarea wire:model.live="goals" name="goals[]" :value="$goal->content" rows="2" />
                            </div> --}}
                        </div>
                        <div>
                            {{-- <x-ts-button x-on:click="showTextarea = true" icon="pencil" color="white" light sm /> --}}
                            <x-ts-button wire:click="deleteSpecificGoal({{ $goal->id }})" icon="trash" color="white" light sm />
                        </div>
                        {{-- <div x-show="showTextarea">
                            <x-ts-button wire:click="saveSpecificGoal({{ $goal->id }})" icon="check" color="white" light sm />
                            <x-ts-button x-on:click="showTextarea = false" icon="x-mark" color="white" light sm />
                        </div> --}}
                    </div>
                @empty
                    <p x-show="!showTextarea" x-collapse>Nenhum objetivo específico adicionado</p>
                @endforelse
                <div x-show="showTextarea" x-collapse class="py-1">
                    <x-ts-textarea wire:model="specificContent" rows="2"
                        placeholder="Adicionar objetivo específico" />
                </div>
                <div class="mt-4">
                    <x-ts-button x-show="!showTextarea" x-on:click="showTextarea = true" text="Adicionar objetivo específico" />
                    <x-ts-button x-show="showTextarea" wire:click="saveSpecificGoal" text="Salvar" />
                    <x-ts-button x-show="showTextarea" x-on:click="showTextarea = false" color="white"
                        text="Cancelar" />
                </div>
            </x-ts-card>
        </div>
    </div>
</section>
