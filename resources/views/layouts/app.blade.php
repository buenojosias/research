<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ @$title ? @$title . ' - ' : '' }} {{ config('app.name', 'Research') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <div class="stack">
            <div class="flex gap-4">
                <x-application-logo class="h-8" />
                <div class="text-lg font-medium text-gray-700">Entrevistas</div>
            </div>
            <div class="flex gap-2">
                @include('includes.header-projects')
                <x-ts-avatar :model="auth()->user()" sm />
            </div>
        </div>
        <nav>
            <x-nav-link label="Projeto" href="#" />
            <x-nav-link label="Bibliometria" href="#" />
            <x-nav-link label="Entrevistas" href="#" />
            <x-nav-link label="Produções" href="#" />
            <x-nav-link label="Arquivos" href="#" :active="request()->routeIs('bibliometrics.files*')" />
            <x-nav-link label="Códigos" href="#" />
            <x-nav-dropdown label="Inserir">
                <a href="#">Produção</a>
                <a href="#">Entrevista</a>
                <a href="#">Arquivo</a>
            </x-nav-dropdown>
            <x-nav-dropdown label="Relatórios">
                <a href="#">Palavras-chave</a>
                <a href="#">Contagem de palavras</a>
                <a href="#">Ranking de palavras</a>
                <a href="#">Nuvem de palavras</a>
            </x-nav-dropdown>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    @livewireScripts
    @stack('scripts')
</body>

</html>
