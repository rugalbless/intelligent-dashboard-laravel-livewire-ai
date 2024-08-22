<button {{ $attributes->merge(['type' => 'submit', 'class' => 'relative z-0 h-12 rounded-full bg-lime-900 px-6 font-bold text-white after:absolute after:left-0 after:top-0 after:-z-10 after:h-full after:w-full after:rounded-full after:bg-lime-600	 hover:after:scale-x-125 hover:after:scale-y-150 hover:after:opacity-0 hover:after:transition hover:after:duration-500']) }}>
    {{ $slot }}
</button>
