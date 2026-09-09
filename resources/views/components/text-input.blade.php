@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-full bg-white/5 border border-white/10 py-3 px-5 text-sm text-white placeholder-white/25 focus:outline-none focus:ring-2 focus:ring-[#F0479E]/50 focus:border-[#F0479E]/50 transition-colors duration-200']) }}>
