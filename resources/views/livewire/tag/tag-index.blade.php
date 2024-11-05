<div>
    <x-ts-toast />
    <x-page-header title="Tags do projeto" />
    <div class="flex">
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
                                    {{ $tag->name }}
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
                                                <span class="ml-2">&rarr;</span> {{ $subtag->name }}
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
        </div>
    </div>
</div>
