<x-admin-layout>
  <div class="w-full h-full">
    <div class="flex flex-col h-full gap-4">
      <div>
        <p class="mb-1 text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Hola, {{ Auth::user()->name }}!</p>
      </div>
      <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="col-span-2">
          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
            <livewire:admin.charts.column/>
          </div>
        </div>
        <div class="col-span-1">
          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
            <livewire:admin.charts.pie/>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>
