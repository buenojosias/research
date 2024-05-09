@props(['title', 'subtitle' => null])

<div class="header">
    <div>
        <h1>{{ $title }}</h1>
        @if ($subtitle)
            <h2>{{ $subtitle }}</h2>
        @endif
    </div>
    <div>
        {{ $slot }}
    </div>
</div>
