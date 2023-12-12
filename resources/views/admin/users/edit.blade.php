<x-admin-layout>
  <div class="w-full h-full">
    <div class="flex flex-col h-full gap-4">
      <div class="flex items-center justify-between">
        <p class="text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Editar Usuario</p>
        <a href="{{ route('admin.users.index') }}">
          <x-secondary-button type="button" class="gap-2">
            <ion-icon name="list-circle-outline" wire:ignore class="text-lg"></ion-icon>Bandeja de entrada
          </x-secondary-button>
        </a>
      </div>
      <div>
        <div>
          <livewire:admin.users.update-form :user="$user"/>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>
