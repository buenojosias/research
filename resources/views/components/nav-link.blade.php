@props([
    'active',
    'label'
])

@php
$classes = ($active ?? false)
            ? 'bg-primary-900 text-white rounded-md px-3 py-2 text-sm font-medium transition duration-150 ease-in-out'
            : 'text-primary-50 hover:bg-primary-950 hover:text-gray-100 rounded-md px-3 py-2 text-sm font-medium transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $label }}
</a>
