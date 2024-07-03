@auth
    <x-app-layout>
        @livewire('dashboard.dashboard-index')
    </x-app-layout>
@else
    @include('landing')
@endauth
