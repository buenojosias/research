<div>
    <x-page-header title="Estatísticas por autor" />
    <div class="sm:flex gap-x-6">
        @include('includes.records-nav')
        <div class="flex-auto grid grid-cols-6 gap-x-6">
            <div class="col-span-2">
                <x-table class="screen">
                    <x-slot name="header">
                        <th class="cursor-pointer" wire:click="ksort">Autor</th>
                        <th class="cursor-pointer" wire:click="arsort">Produções</th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($authors as $key => $author)
                            <tr>
                                <td>
                                    <span class="cursor-pointer"
                                        wire:click="selectAuthor('{{ $key }}')">{{ $key }}</span>
                                </td>
                                <td width="1" class="text-center">{{ $author }}</td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>

            <div class="col-span-4">
                sadfsdf
            </div>
        </div>
    </div>
</div>
</div>
