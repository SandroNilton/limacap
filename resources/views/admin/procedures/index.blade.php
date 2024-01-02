<x-admin-layout>
  <div class="w-full h-full">
    <div class="flex flex-col h-full gap-4">
      <div class="flex items-center justify-between">
        <p class="text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Trámites, <span class="text-[#10B981]">{{ Auth::user()->area ? Auth::user()->area->name : "Admin" }} {{auth()->user()->area_id}}</span></p>
      </div>
      <div class="grid grid-cols-1">
        <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
          <livewire:admin.procedures.procedure-table/>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>
