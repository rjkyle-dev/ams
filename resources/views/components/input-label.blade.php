@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-md text-black font-semibold']) }}>
    {{ $value ?? $slot }}
</label>
