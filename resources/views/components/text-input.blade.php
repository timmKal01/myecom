@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full border border-[#dbe4e2] rounded-lg py-2.5 px-4 text-sm text-[#1a2332] placeholder-[#9aa5a3] focus:outline-none focus:ring-2 focus:ring-[#14b8a6]/30 focus:border-[#14b8a6] transition-colors duration-200']) }}>
