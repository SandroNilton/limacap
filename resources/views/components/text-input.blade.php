@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border-gray-300 focus:border-[#10B981] dark:focus:border-[#10B981] focus:ring-[#10B981] rounded-md py-1.5 text-sm']) !!}>
