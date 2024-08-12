<div>
    <div class="overflow-x-auto dark:border-solid border border-slate-500 border-solid border-2 border-slate-400 rounded-md ">
        <table class="divide-y divide-gray-300 w-full">
            <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                @foreach($columns as $column)
                    <th scope="col" @class(["px-3 py-3.5 text-left text-sm font-semibold text-gray-900  dark:text-white"]) >{{ $column['label'] }}</th>
                @endforeach

                @if($edit)

                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Edit</span>
                    </th>
                @endif

                @if($delete)
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Delete</span>
                    </th>
                @endif


            </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-slate-500">
            @foreach($items as $item)
                <tr class="bg-white  dark:bg-gray-700">
                    @foreach($columns as $column)
                        <td class="whitespace-nowrap px-3 py-4 text-base text text-gray-500 dark:text-white">{{ data_get($item, $column['column']) }}</td>
                    @endforeach

                    @if($edit)
                        <td class="whitespace-nowrap px-3 py-4 text-sm font-extrabold text-yellow-500 dark:text-yellow-500">
                            <a href="{{ route($edit, $item->id) }}" class="text-yellow-500 hover:text-yellow-600 dark:text-yellow-300 dark:hover:text-gray-400">{{ __('Edit') }}</a>
                        </td>
                    @endif

                    @if($delete)
                        <td class="whitespace-nowrap px-3 py-4 text-sm font-extrabold text-red-500 dark:text-red-400">

                            {{ __('Delete') }}

                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="py-4">
        {{ $items->links() }}
    </div>
</div>
