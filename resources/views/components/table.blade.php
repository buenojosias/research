@props(['label' => null])
<div class="bg-white rounded-lg">
    @if ($label)
        <div class="p-4 text-gray-800 font-semibold">
            {{ $label }}
        </div>
    @endif
    <div class="overflow-x-auto">
        <table>
            <thead class="rounded">
                <tr>
                    {{ $header }}
                </tr>
            </thead>
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
</div>
