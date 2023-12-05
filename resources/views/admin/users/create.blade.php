<x-admin-layout>
  <div class="w-full h-full">
    <div class="flex flex-col h-full gap-4">
      <div class="flex items-center justify-between">
        <p class="text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Nuevo Usuario</p>
        <a href="{{ route('admin.users.index') }}">
          <x-secondary-button type="button" class="gap-2">
            <ion-icon name="list-circle-outline" wire:ignore class="text-lg"></ion-icon>Lista
          </x-secondary-button>
        </a>
      </div>
      <div>
        <div>
          <livewire:admin.users.register-form/>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>
