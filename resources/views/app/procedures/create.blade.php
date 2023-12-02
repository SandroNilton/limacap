<x-app-layout>
  <div class="w-full h-full">
    <div class="flex flex-col h-full gap-4">
      <div class="flex justify-between items-center">
        <p class="text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Nuevo Trámite</p>
        <a href="{{ route('app.procedures.index') }}">
          <x-primary-button type="button" class="gap-2">
            <ion-icon name="list-circle-outline" wire:ignore class="text-lg"></ion-icon>Lista
          </x-primary-button>
        </a>
      </div>
      <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="col-span-2">
          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
            <livewire:app.procedures.register-form/>
          </div>
        </div>
        <div class="col-span-1">
          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
