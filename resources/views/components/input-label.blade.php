@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-black text-lg dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
