<x-admin-layout>
  <div class="w-full h-full">
    <div class="flex flex-col h-full gap-4">
      <div class="flex items-center justify-between">
        <p class="text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Editar Trámite, <span class="text-[#10B981]">{{ $procedure->id }}</span></p>
        <a href="{{ route('admin.procedures.index') }}">
          <x-secondary-button type="button" class="gap-2">
            <ion-icon name="list-circle-outline" wire:ignore class="text-lg"></ion-icon>Lista
          </x-secondary-button>
        </a>
      </div>
      <div class="grid grid-cols-4 gap-6">
        <div>
          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
            <livewire:admin.procedures.data :procedure="$procedure"/>
          </div>
        </div>
        @if ($procedure->state == 4 || $procedure->state == 5)
        @else
          <div>
            <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
              <livewire:admin.procedures.assignment :procedure="$procedure"/>
            </div>
          </div>
        @endif
        
        <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
          
        </div>
        <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
          
        </div>
        <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
          
        </div>
        <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
          
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>


