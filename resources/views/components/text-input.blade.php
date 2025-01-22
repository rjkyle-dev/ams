@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge(['class' => '
        block w-full border-0 border-b-2 border-gray-300 
        focus:ring-0 focus:border-indigo-500 
        rounded-none shadow-none
    ']) }}
>
