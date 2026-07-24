@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-[#6A1E55] focus:ring-[#6A1E55] rounded-lg shadow-sm backdrop-blur-sm']) }}>