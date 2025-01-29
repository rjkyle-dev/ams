{{-- Main Navlink --}}
@props(['active' => false])

<a 
    class="{{ $active ? 'text-yellow-300 border-b-4 border-yellow-300 transform scale-125 linear transition-transform' : 'text-gray-100' }} nav-link"
    aria-current="{{ $active ? 'page' : 'false' }}"
    {{ $attributes }}
>
    {{ $slot }}
</a>
