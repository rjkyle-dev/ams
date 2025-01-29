{{-- Main Navlink --}}
@props(['active' => false])

<a class="{{ $active ? 'bg-yellow-600 px-3 py-2 text-white font-bold rounded transform scale-75 linear transition-transform' : 'text-gray-100 hover:text-yellow-400 hover:font-semibold transition-all font-black' }} nav-link"
    aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}
</a>
