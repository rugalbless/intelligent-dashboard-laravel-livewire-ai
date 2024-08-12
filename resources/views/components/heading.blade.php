



<div class="sm:flex sm:items-center pb-8">
    <div class="sm:flex-auto">
        <h1 class=" text-4xl font-extrabold dark:text-white">
            {{ $title }}</h1>
            <p class=" mt-2 text-xl text-gray-700 dark:text-gray-100">
                 {{ $description }} </p>
    </div>
    @if($btnLabel)
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ $route }}" class="inline-flex items-center justify-center rounded-md border border-transparent
            bg-sky-600 px-4 py-2 text-base font-extrabold text-white hover:bg-sky-800 focus:outline-none
            focus:ring-1 focus:ring-sky-800 focus:ring-offset-1 sm:w-auto dark:shadow-[0_10px_50px_rgba(8,_112,_184,_0.7)] ">
                {{ $btnLabel }}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 ml-2">
                    <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                </svg>
            </a>
        </div>
    @endif
</div>
