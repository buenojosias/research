<div class="sm:relative" x-data="{ open: false }" @click.outside="open = false">
    <x-ts-button text="Meus projetos" icon="chevron-down" position="right" @click="open = !open" class="w-36" sm outline />
    <div class="fixed sm:absolute right-0 sm:right-0 top-12 sm:top-10 w-screen sm:w-[300px] bg-white pr-1.5 rounded-lg drop-shadow-xl border"
        x-show="open" x-transition>
        <!-- heading -->
        <div class="flex items-center justify-between gap-2 p-4 pb-2">
            <h3 class="font-bold text-xl">Meus projetos</h3>
            <div class="relative gap-2.5" x-data="{ actions: false }" @click.outside="actions = false">
                <button type="button" class="p-1 flex rounded-full focus:bg-gray-100 dark:text-white"
                    @click="actions = !actions">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M4.5 12a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm6 0a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm6 0a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="absolute right-0 w-[280px] bg-white shadow-lg z-10 rounded-lg border border-gray-100"
                    x-show="actions" x-transition>
                    <nav class="text-sm flex flex-col p-2">
                        <a href="#"
                            class="flex gap-x-2 items-center active:bg-sky-100 focus:bg-gray-100 p-2 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Mark all as read</a>

                        <a href="#"
                            class="flex gap-x-2 items-center active:bg-sky-100 focus:bg-gray-100 p-2 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.143 17.082a24.248 24.248 0 0 0 3.844.148m-3.844-.148a23.856 23.856 0 0 1-5.455-1.31 8.964 8.964 0 0 0 2.3-5.542m3.155 6.852a3 3 0 0 0 5.667 1.97m1.965-2.277L21 21m-4.225-4.225a23.81 23.81 0 0 0 3.536-1.003A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6.53 6.53m10.245 10.245L6.53 6.53M3 3l3.53 3.53" />
                            </svg>
                            Criar novo
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="text-sm h-[400px] w-full overflow-y-auto pr-2">
            <!-- contents list -->
            <div class="pl-2 p-1 text-sm font-normal dark:text-white">

                aqui vão as listas

            </div>

        </div>

        <!-- footer -->
        <a href="#">
            <div
                class="text-center py-4 border-t border-slate-100 text-sm font-medium text-blue-600 dark:text-white dark:border-gray-600">
                Criar novo </div>
        </a>

        <div
            class="w-3 h-3 absolute -top-1.5 right-3 bg-white border-l border-t rotate-45 max-sm:hidden dark:bg-dark3 dark:border-transparent">
        </div>
    </div>
</div>
