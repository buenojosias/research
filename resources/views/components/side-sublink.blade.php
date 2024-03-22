@props(['active', 'label', 'href' => '#'])

@php
    $classes =
        $active ?? false
            ? 'my-1.5 text-base text-gray-900 font-normal rounded bg-slate-200 hover:bg-slate-400 hover:text-gray-100 group transition duration-75 flex items-center p-2'
            : 'my-1.5 text-base text-yell-900 font-normal rounded hover:bg-slate-400 hover:text-gray-100 group transition duration-75 flex items-center p-2';
@endphp

<li>
    <a href="{{ $href }}" class="flex items-center px-2 py-1.5 pl-11 w-full text-sm font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ $label }}</a>
</li>

