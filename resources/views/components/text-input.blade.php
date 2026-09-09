@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full border border-line rounded-lg py-2.5 px-4 text-sm text-ink placeholder-ink-muted/50 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition-colors duration-200 bg-surface']) }}>
