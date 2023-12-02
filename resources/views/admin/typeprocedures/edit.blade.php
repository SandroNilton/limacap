<x-admin-layout>
  <div class="w-full h-full">
    <div class="flex flex-col h-full gap-4">
      <div class="flex items-center justify-between">
        <p class="text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Editar Tipo de Trámite</p>
        <a href="{{ route('admin.typeprocedures.index') }}">
          <x-secondary-button type="button" class="gap-2">
            <ion-icon name="list-circle-outline" wire:ignore class="text-lg"></ion-icon>Lista
          </x-secondary-button>
        </a>
      </div>
      <div>
        <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
          <livewire:admin.typeprocedures.update-form :typeprocedure="$typeprocedure"/>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>
