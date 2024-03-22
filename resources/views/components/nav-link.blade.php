@props([
    'active',
    'label'
])

@php
$classes = ($active ?? false)
            ? 'bg-secondary text-secondary-content rounded-md px-3 py-2 text-sm font-medium transition duration-150 ease-in-out'
            : 'text-secondary-content hover:bg-secondary-light hover:text-white rounded-md px-3 py-2 text-sm font-medium transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $label }}
</a>
