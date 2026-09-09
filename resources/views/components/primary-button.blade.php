<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full inline-flex items-center justify-center rounded-full bg-gradient-to-r from-[#14b8a6] to-[#2563eb] px-6 py-3 font-semibold text-sm text-white hover:opacity-90 hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-[#14b8a6]/20']) }}>
    {{ $slot }}
</button>
