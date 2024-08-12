<div
    x-show="menuVisibility"
    class="relative z-40 md:hidden" role="dialog" aria-modal="true">

    <div
        x-show="menuVisibility"
        @click="menuVisibility = false"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>

    <div class="fixed inset-0 z-40 flex">

        <div
            x-show="menuVisibility"
            @click.outside="menuVisibility = false"
            x-transition:enter="transition ease-in-out transform duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out transform duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="relative flex w-full max-w-xs flex-1 flex-col bg-gray-800 pt-5 pb-4  ">
            <div
                x-show="menuVisibility"
                x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute top-0 right-0 -mr-12  pt-2">
                <button
                    @click="menuVisibility = false"
                    type="button"
                    class="ml-1 flex h-10 w-10 items-center  justify-center rounded-full   "
                >
                    <svg class="h-8 w-8 text-white hover:text-red-500 transition-all  hover:drop-shadow-custom " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <x-logo />

            <div class="mt-5 h-0 flex-1 overflow-y-auto">
                <x-side-bar-items />
            </div>
        </div>

        <div class="w-14 flex-shrink-0" aria-hidden="true">
        </div>
    </div>
</div>

<div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col ">
    <div class="flex min-h-0 flex-1 flex-col bg-gray-800 dark:bg-gray-800">

        <div class="flex flex-shrink-0 items-center px-4 py-4 ">
            <img class=" max-w-[1080px] w-96 size-32 -ml-24 -mb-14" src="{{ Vite::asset("resources/assets/logo.svg") }}" alt="Your Company">
        </div>

        <hr class="my-12 h-px border-t-0 bg-transparent bg-gradient-to-r from-transparent via-neutral-200 to-transparent opacity-35 dark:via-neutral-100" />

        <div class="flex flex-1 flex-col overflow-y-auto">
            <x-side-bar-items />
        </div>
    </div>
</div>
