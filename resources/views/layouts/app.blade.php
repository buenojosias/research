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
    <script src="https://d3js.org/d3.v5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/jasondavies/d3-cloud/build/d3.layout.cloud.js"></script>
</head>

<body>
    <header>
        <div class="stack">
            <div class="flex gap-4">
                <x-application-logo class="h-8" />
                <div class="text-lg font-medium text-gray-700">
                    @if (request()->routeIs('*bibliometric*'))
                        Bibliometria
                    @elseif (request()->routeIs('*interview*'))
                        Entrevistas
                    @endif
                </div>
            </div>
            <div class="flex gap-2">
                @include('includes.header-projects')
                <x-ts-avatar :model="auth()->user()" sm />
            </div>
        </div>
        <nav>
            @if (request()->routeIs('project.*'))
                <x-nav-link label="Projetos" :href="route('projects.index')" />
            @endif
            @if (request()->routeIs('*bibliometric*'))
                <x-nav-link label="Projeto" :href="route('project.show', request()->route()->project)" />
                <x-nav-link label="Produções" :href="route('project.bibliometrics.productions.index', request()->route()->project)" :active="request()->routeIs('*productions*')" />
                <x-nav-link label="Arquivos" :href="route('project.bibliometrics.files.index', request()->route()->project)" :active="request()->routeIs('*bibliometrics.files*')" />
                <x-nav-link label="Referências" :href="route('project.bibliometrics.references.index', request()->route()->project)" :active="request()->routeIs('*bibliometrics.references*')" />
                <x-nav-link label="Citações" :href="route('project.bibliometrics.citations.index', request()->route()->project)" :active="request()->routeIs('*bibliometrics.citations*')" />
                {{-- <x-nav-link label="Códigos" href="#" /> --}}
                <x-nav-dropdown label="Inserir">
                    <a href="{{ route('project.bibliometrics.productions.create', request()->route()->project) }}">Produção</a>
                    {{-- <a href="#">Entrevista</a> --}}
                    <a href="#">Arquivo</a>
                </x-nav-dropdown>
                <x-nav-dropdown label="Relatórios">
                    <a href="{{ route('project.bibliometrics.content.index', request()->route()->project) }}">Coteúdo</a>
                    <a href="{{ route('project.bibliometrics.content.goals', request()->route()->project) }}">Objetivos</a>
                    <a href="{{ route('project.bibliometrics.keywords.index', request()->route()->project) }}">Palavras-chave</a>
                    <a href="{{ route('project.bibliometrics.wordcounts.index', request()->route()->project) }}">Contagem de palavras</a>
                    <a href="{{ route('project.bibliometrics.wordrankings.index', request()->route()->project) }}">Ranking de palavras</a>
                    <a href="#">Nuvem de palavras</a>
                    <a href="{{ route('project.bibliometrics.records.index', request()->route()->project) }}">Estatísticas</a>
                </x-nav-dropdown>
            @endif
            @if (request()->routeIs('project.show'))
                <x-nav-link label="Entrevistas" href="#" />
                <x-nav-link label="Bibliometria" :href="route('project.bibliometrics.show', request()->route()->project)" />
            @elseif (request()->routeIs('project.bibliometric*'))
                {{-- <x-nav-link label="Entrevistas" href="#" /> --}}
            @elseif (request()->routeIs('project.interview*'))
                <x-nav-link label="Bibliometria" :href="route('project.bibliometrics.show', request()->route()->project)" />
            @else
                <x-nav-link label="Dashboard" href="{{ route('dashboard') }}" />
                <x-nav-link label="Estudantes" href="{{ route('students.index') }}" />
                <x-nav-link label="Projetos" href="{{ route('projects.index') }}" />
            @endif
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    @livewireScripts
    @stack('scripts')
</body>

</html>
