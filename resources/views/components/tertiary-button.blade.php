<button {{ $attributes->merge(['type' => 'button', 'class' => 'bg-gradient-to-r from-blue-500 to-sky-900 hover:from-stone-600 hover:to-stone-600 inline-flex items-center px-4 py-2 rounded-md font-semibold text-lg text-white uppercase tracking-widest shadow-sm hover:bg-blue-800  ']) }}>
    {{ $slot }}
</button>
