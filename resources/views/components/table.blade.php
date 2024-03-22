@props(['students'])
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
