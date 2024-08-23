<button type="button" {{ $attributes->merge([
    'class' => 'relative z-0 h-12 rounded-md bg-red-700 hover:bg-red-800 px-6 font-bold text-white px-4 py-2 transition-transform
     duration-300 ease-in-out transform hover:translate-y-[-6px] hover:drop-shadow-custom '
]) }} onclick="goBack()">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 ">
        <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
    </svg>
    {{ __('Back') }}
</button>


<script>
    function goBack() {
        window.history.back();
    }
</script>
