<button {{ $attributes->merge(['type' => 'submit',
 'class' => 'relative z-0 h-12 rounded-md bg-lime-600 hover:bg-lime-500 px-6 font-bold text-white transition-transform
 duration-300 ease-in-out transform hover:translate-y-[-6px] hover:drop-shadow-custom ']) }}>
    {{ $slot }}
</button>
