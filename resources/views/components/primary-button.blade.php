<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full inline-flex items-center justify-center rounded-full bg-gradient-to-r from-[#FF7A45] via-[#F0479E] to-[#8B5CF6] px-6 py-3.5 font-semibold text-sm text-white hover:opacity-90 hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-[#F0479E]/20']) }}>
    {{ $slot }}
</button>
