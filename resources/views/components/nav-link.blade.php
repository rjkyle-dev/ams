{{-- Main Navlink --}}
@props(['active' => false])

<a class="{{ $active ? 'text-yellow-300 border-b-2 border-yellow-300 transform scale-125 linear transition-transform' : 'text-gray-100 hover:text-yellow-400 hover:font-semibold transition-all' }} nav-link"
    aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}
</a>
