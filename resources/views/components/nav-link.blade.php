@props([
    'active',
    'label'
])

@php
$classes = ($active ?? false)
            ? 'nav-item active'
            : 'nav-item';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} wire:navigate>
    {{ $label }}
</a>
