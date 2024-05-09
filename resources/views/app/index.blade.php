<x-app-layout>
  <div class="w-full h-full">
    <div class="flex flex-col h-full gap-4">
      <div>
        <p class="mb-1 text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Hola, {{ Auth::user()->name }}!</p>
      </div>
      <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div>
          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
            <iframe height="450" class="w-full scroll" src="https://www.instagram.com/lima_cap/embed" frameborder="0" scrolling="yes" allowtransparency="true"></iframe>
          </div>
        </div>
        <div>
          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
            <iframe height="450" class="w-full scroll" src="https://limacap.org/formulario-de-pago/" frameborder="0" scrolling="yes" allowtransparency="true"></iframe>
          </div>
        </div>
        <div>
          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
            <embed height="450" class="w-full scroll" src="https://bialima.org/">
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
