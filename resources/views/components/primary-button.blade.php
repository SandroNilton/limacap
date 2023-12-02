<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-3 py-1.5 bg-[#10B981] rounded-md font-medium uppercase text-xs text-white tracking-widest focus:outline-none focus:ring-0 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
