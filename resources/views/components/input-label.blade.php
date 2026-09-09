@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-xs font-medium text-white/60 mb-1.5 uppercase tracking-wide']) }}>
    {{ $value ?? $slot }}
</label>
