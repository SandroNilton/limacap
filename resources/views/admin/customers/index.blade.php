<x-admin-layout>
  <div class="w-full h-full">
    <div class="flex flex-col h-full gap-4">
      <div class="flex items-center justify-between">
        <p class="text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Clientes</p>
      </div>
      <div class="grid grid-cols-1">
        <div>
          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
            <livewire:admin.customers.customer-table />
          </div>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>