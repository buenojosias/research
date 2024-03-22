@props(['active', 'label', 'href' => null])

@php
    $classes =
        $active ?? false
            ? 'my-1.5 text-base text-gray-900 font-normal rounded bg-primary-400 group transition duration-75 flex items-center p-2 w-full'
            : 'my-1.5 text-base text-gray-50 font-normal rounded hover:bg-primary-500 hover:text-gray-100 group transition duration-75 flex items-center p-2';
@endphp

@if ($href)
    <li>
        <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
            <svg aria-hidden="true"
                class="mr-3 w-6 h-6 text-primary-900 transition duration-75 group-hover:text-primary-800"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
            </svg>
            <span class="flex-1">{{ $label }}</span>
            <div
                class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold text-primary-800">
                {{ $slot }}
            </div>
        </a>
    </li>
@else
    <li x-data="{ show: false }">
        <button @click="show = !show" type="button" :class="'flex items-center p-2 w-full'"
            {{ $attributes->merge(['class' => $classes]) }} aria-controls="dropdown-pages"
            data-collapse-toggle="dropdown-pages">
            <svg aria-hidden="true"
                class="w-6 h-6 text-primary-900 transition duration-75 group-hover:text-primary-800"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="flex-1 ml-3 text-left whitespace-nowrap">{{ $label }}</span>
            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <ul x-show="show" x-transition class="space-y-1">
            {{ $slot }}
        </ul>
    </li>
@endif
