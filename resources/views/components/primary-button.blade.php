<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-lime-700 shadow-[0_10px_50px_rgba(20,201,0,_0.7)] border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-lime-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
