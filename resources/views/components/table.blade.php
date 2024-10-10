@props(['label' => null, 'screen' => null, 'collapsable' => null])
@php
    $classes = $screen ?? false ? 'screen overflow-y-auto' : 'overflow-y-auto';
@endphp
<div class="bg-white rounded-lg" x-data="{ expanded: {{ $collapsable ? 'false' : 'true' }} }">
    <div class="flex justify-between">
        @if ($label)
            <div class="p-4 border-b text-gray-800 font-semibold">
                {{ $label }}
            </div>
        @endif
        @if ($collapsable)
            <div class="justify-self-end p-4">
                <x-ts-button x-on:click="expanded = !expanded" sm flat>
                    <x-ts-icon name="chevron-down" class="w-5 h-5 transition"
                        x-bind:class="expanded ? 'rotate-180' : ''" />
                </x-ts-button>
            </div>
        @endif
    </div>
    <div {{ $attributes->merge(['class' => $classes]) }} x-show="expanded" x-collapse>
        <table>
            @if (isset($header))
                <thead class="rounded">
                    <tr>
                        {{ $header }}
                    </tr>
                </thead>
            @endif
            {{ $slot }}
            <tbody>
                {{ $body }}
            </tbody>
        </table>
    </div>
    @if (isset($footer))
        <div class="card-footer px-4 pb-4">
            {{ $footer }}
        </div>
    @endif
    @if (isset($pagination))
        <div class="p-2">
            {{ $pagination }}
        </div>
    @endif
</div>
