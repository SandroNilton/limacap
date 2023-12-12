<x-admin-layout>
  <div class="w-full h-full">
    <div class="flex flex-col h-full gap-4">
      <div class="flex items-center justify-between">
        <p class="text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Editar Trámite, <span class="text-[#10B981]">{{ $procedure->id }}</span></p>
        <a href="{{ route('admin.procedures.index') }}">
          <x-secondary-button type="button" class="gap-2">
            <ion-icon name="list-circle-outline" wire:ignore class="text-lg"></ion-icon>Bandeja de entrada
          </x-secondary-button>
        </a>
      </div>
      <div>
        <livewire:admin.procedures.main :procedure="$procedure"/>
      </div>
    </div>
  </div>
</x-admin-layout>


