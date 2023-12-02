<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-3 py-1.5 bg-white rounded-md font-medium border border-[#e9ebec] uppercase text-xs text-[rgb(17,24,39)] text-opacity-100 tracking-widest focus:outline-none focus:ring-0 transition ease-in-out duration-150']) }}>
  {{ $slot }}
</button>
