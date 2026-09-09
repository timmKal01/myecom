@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-[#0f766e]']) }}>
        {{ $status }}
    </div>
@endif
