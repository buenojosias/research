@props(['active', 'label'])

@php
    $classes = $active ?? false ? 'nav-item cursor-pointer active' : 'nav-item cursor-pointer';
@endphp

<div x-data="{ dropdown: false }">
    <div x-on:click="dropdown = !dropdown" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $label }}
        <x-ts-icon name="chevron-down" class="w-4 h-4 mt-0.5" />
    </div>
    <div x-show="dropdown" x-on:click.outside="dropdown = false" x-transition class="nav-dropdown">
        {{ $slot }}
    </div>
</div>
