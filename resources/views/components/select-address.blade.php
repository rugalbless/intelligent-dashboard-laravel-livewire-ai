@props(['disabled' => null, 'selectedValue' => null])

<select id="address_id" name="address_id" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 border-gray-200 bg-gray-300 dark:bg-gray-600 dark:text-gray-100 text-gray-800 focus:border-sky-200 focus:ring-offset-2 focus:border-sky-600 focus:ring-indigo-500 focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
    @foreach (App\Models\Address::all() as $option)
        <option {{ isset($selectedValue) && $option->id == $selectedValue->id ? 'selected' : '' }} value="{{ $option->id }}" >{{ $option->city.' - '.$option->state }}</option>
    @endforeach
</select>
