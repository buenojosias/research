<x-app-layout>
    <x-ts-dialog />
    <x-ts-toast />
    @slot('title')
        {{ $title }}
    @endslot
    <section>
        <x-page-header :title="$title" :subtitle="$production->title" />
        <div class="flex gap-x-6">
            @include('includes.production-nav')
            {{ $slot }}
        </div>
    </section>
</x-app-layout>
