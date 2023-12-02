<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-3 py-1.5 text-white uppercase rounded-md font-medium text-xs bg-red-600 tracking-widest focus:outline-none focus:ring-0 transition ease-in-out duration-150']) }}>
  {{ $slot }}
</button>
