@props(['value'])

<label {{ $attributes->merge(['class' => 'flex items-center mb-2 font-semibold text-sm']) }}>
    {{ $value ?? $slot }}
</label>
