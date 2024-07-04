@props(['label' => null, 'screen' => null])
@php
    $classes = $screen ?? false ? 'screen overflow-y-auto' : 'overflow-y-auto';
@endphp
<div class="bg-white rounded-lg">
    @if ($label)
        <div class="p-4 border-b text-gray-800 font-semibold">
            {{ $label }}
        </div>
    @endif
    <div {{ $attributes->merge(['class' => $classes]) }}>
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
