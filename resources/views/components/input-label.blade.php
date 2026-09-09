@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-ink mb-1.5']) }}>
    {{ $value ?? $slot }}
</label>
