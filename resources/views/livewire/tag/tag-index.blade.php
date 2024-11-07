<div>
    <x-ts-toast />
    <x-page-header title="Tags do projeto" />
    <div class="flex flex-col lg:flex-row gap-6">
        <div>
            <x-table screen>
                <x-slot name="header">
                    <th>Tag</th>
                    <th>Produções</th>
                </x-slot>
                <x-slot name="body">
                    @foreach ($tags as $tag)
                        <div x-data="{ showsubtags: false }">
                            <tr>
                                <td class="font-semibold text-gray-900">
                                    <a wire:click="selectTag({{ $tag }})"
                                        class="cursor-pointer">{{ $tag->name }}</a>
                                    @if ($tag->subtags->count() > 0)
                                        <x-ts-button icon="plus" sm flat x-on:click="showsubtags = !showsubtags" />
                                    @endif
                                </td>
                                <td class="text-right">
                                    {{ $tag->productions_count }}
                                </td>
                            </tr>
                            @if ($tag->subtags->count() > 0)
                                <div class="pl-2" x-show="showsubtags">
                                    @foreach ($tag->subtags->sortBy('name') as $subtag)
                                        <tr>
                                            <td class="text-gray-700">
                                                <span class="ml-2">&rarr;</span>
                                                <a wire:click="selectTag({{ $subtag }})"
                                                    class="cursor-pointer">{{ $subtag->name }}</a>
                                            </td>
                                            <td class="text-right">{{ $subtag->productions_count }}</td>
                                        </tr>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </x-slot>
            </x-table>
            <div class="mt-4">
                <x-ts-button text="Nova tag" wire:click="$toggle('modal')" class="w-full" />
            </div>
        </div>

        <div class="lg:w-2/3 space-y-4">
            @if ($selectedTag)
                <x-table>
                    <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                        <h4>Publicações com a tag: {{ $selectedTag->name }}</h4>
                        <x-ts-button wire:click="unselectTag" icon="x-mark" flat />
                    </div>
                    <x-slot name="header">
                        <th>Título</th>
                        <th width="40%">Tags</th>
                        <th>Tipo</th>
                        <th width="1"></th>
                    </x-slot>
                    <x-slot name="body">
                        @forelse ($selectedTag->productions as $production)
                            <tr>
                                <td class="!text-wrap">
                                    <a
                                        href="{{ route('project.bibliometrics.productions.show', [$project, $production]) }}">
                                        {{ $production->full_title }}
                                        ({{ $production->year }})
                                    </a>
                                </td>
                                <td class="!text-wrap">
                                    {{-- @foreach ($data as $kws)
                                        {{ $kws }}
                                        @if (!$loop->last)
                                            /
                                        @endif
                                    @endforeach --}}
                                </td>
                                <td>
                                    {{ $production->type }}
                                </td>
                                <td>
                                    <x-ts-button wire:click="deleteProduction({{ $production }})"
                                        icon="archive-box-arrow-down" color="red" flat sm />
                                </td>
                            </tr>
                        @empty
                            <div class="p-4 border-t">Nenhuma produção vinculada com esta tag.</div>
                        @endforelse
                    </x-slot>
                </x-table>

                {{-- <x-table>
                    <div class="px-4 py-2 flex justify-between gap-4 items-center text-gray-800 font-semibold">
                        <h4>Tags relacionadas</h4>
                    </div>
                    <x-slot name="header">
                        <th>Tag</th>
                        <th>Produções em comum</th>
                    </x-slot>
                    <x-slot name="body">
                        @forelse ($commonTags as $common)
                            <tr>
                                <td>
                                    {{ $common['tagB'] }}
                                </td>
                                <td>
                                    {{ $common['common_productions_count'] }}
                                </td>
                            </tr>
                        @empty
                            <div class="p-4 border-t">Nenhuma tag com produções em comum.</div>
                        @endforelse
                    </x-slot>
                </x-table> --}}
            @else
                <x-ts-card>
                    Selecione uma tag na tabela <span class="lg:hidden">abaixo</span> <span
                        class="hidden lg:inline-flex">ao lado</span> para ver as produções relacionadas.
                </x-ts-card>
            @endif
        </div>
    </div>

    <x-ts-modal title="Criar tag" persistent wire size="sm">
        <x-ts-input type="text" wire:model="newTag" placeholder="Nome da tag (use : para criar com subtag)" required />
        <x-slot:footer>
            <x-ts-button text="Salvar" wire:click="createTag" class="w-full" />
        </x-slot:footer>
    </x-ts-modal>
</div>
