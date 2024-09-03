@push('customer-scripts')
    <script src="https://cdn.jsdelivr.net/npm/vega@5.22.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/vega-lite@5.6.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/vega-embed@6.21.0"></script>

    <style media="screen">
        .vega-actions a {
            margin-right: 5px;
        }
    </style>
@endpush

<div x-data="dashboard" >
    <div class="flex flex-col min-h-[calc(100vh-100px)] justify-between mx-auto max-w-7xl px-6 lg:px-8">

        <x-heading
            title="Dashboard"
            description="custom dashboard"
        />

        <div class="flex flex-1 max-w-7xl py-4 overflow-x-auto" x-ref="vegalitecontainer">
            <div id="vis"></div>
        </div>

        <div class="flex flex-col space-y-2 w-full items-end">
            <textarea
                wire:model.debounce.500ms="question"
                class="w-1/2 @error('question') border-red-500 @else border-gray-300 dark:border-gray-400 @enderror dark:bg-gray-700 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-50 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                placeholder="EX: Gráfico de vendas por estado" >
            </textarea>
            @error('question') <span class="text-xs text-red-500">{{ $message }}</span> @enderror


            <x-tertiary-button class="inline-flex justify-center items-end gap-2" @click="generateReport">
                Gerar gráfico
                <svg x-show="loading" class="animate-spin -ml-1 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </x-tertiary-button>
        </div>
    </div>
</div>
