<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full inline-flex items-center justify-center rounded-full bg-gradient-to-r from-accent to-accent-dark px-6 py-3 font-semibold text-sm text-white hover:opacity-90 hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-accent/20']) }}>
    {{ $slot }}
</button>
