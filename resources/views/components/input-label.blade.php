@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-[#1a2332] mb-1.5']) }}>
    {{ $value ?? $slot }}
</label>
