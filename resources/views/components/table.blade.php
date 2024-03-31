@props(['students', 'label' => null])
<div class="bg-white rounded-lg">
    @if ($label)
        <div class="p-4 text-gray-800 font-semibold">
            Cabeçalho
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
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
