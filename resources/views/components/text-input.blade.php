@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-neutral-700 focus:border-[#ADFF2F] focus:ring-[#ADFF2F] rounded-md shadow-sm']) }}>
