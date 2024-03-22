<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Research') }} {{ $title ? ' - '. $title : '' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans antialiased bg-background-default" x-data="{ sidebar: false }">
    <div>
        <nav class="px-4 py-2.5 sm:py-2 bg-primary-800 fixed left-0 right-0 top-0 z-50">
            <div class="sm:flex sm:items-center">
                <div class="w-full sm:w-64 flex justify-start items-center">
                    <button @click="sidebar = !sidebar"
                        class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100">
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg aria-hidden="true" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Toggle sidebar</span>
                    </button>
                    <a href="#" class="flex items-center justify-between mr-4">
                        <x-application-logo class="w-8 fill-white" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Research</span>
                    </a>
                </div>
                <livewire:layout.navstack />
            </div>
        </nav>
        <aside
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 sm:pt-10 transition-transform  bg-white border-r border-gray-200"
            :class="sidebar ? '' : '-translate-x-full md:translate-x-0'" aria-label="Sidenav" id="drawer-navigation">
            @include('layouts.sidebar')
        </aside>
    </div>

    <main class="pb-4 md:ml-64 h-auto pt-24 sm:pt-14 md:pt-[52px]">
        @if (isset($header))
            <header class="z-30 bg-white shadow w-full h-14 flex items-center fixed">
                {{ $header }}
            </header>
        @endif
        {{ $slot }}
    </main>
</body>

</html>
